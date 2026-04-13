<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\ApplicationDirector;
use App\Models\ApplicationMeter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ApplicationController extends Controller
{
    public function services() { return view('backend.new-application.services'); }
    public function finance_services() { return view('backend.new-application.finance_services'); }
    public function utilities_services() { return view('backend.new-application.utilities_services'); }

    public function card_machine() {
        $nextNum = $this->getNextApplicationNumber();
        return view('backend.new-application.finance_services.card_machine', compact('nextNum'));
    }

    public function loan() {
        $nextNum = $this->getNextApplicationNumber();
        return view('backend.new-application.finance_services.loan', compact('nextNum'));
    }

    public function open_banking() {
        $nextNum = $this->getNextApplicationNumber();
        return view('backend.new-application.finance_services.open_banking', compact('nextNum'));
    }

    public function water() {
        $nextNum = $this->getNextApplicationNumber();
        return view('backend.new-application.utilities_services.water', compact('nextNum'));
    }

    public function broadband() {
        $nextNum = $this->getNextApplicationNumber();
        return view('backend.new-application.utilities_services.broadband', compact('nextNum'));
    }

    public function telecom() {
        $nextNum = $this->getNextApplicationNumber();
        return view('backend.new-application.utilities_services.telecom', compact('nextNum'));
    }

    public function gas() {
        $nextNum = $this->getNextApplicationNumber();
        return view('backend.new-application.utilities_services.gas', compact('nextNum'));
    }

    public function electricity() {
        $nextNum = $this->getNextApplicationNumber();
        return view('backend.new-application.utilities_services.electricity', compact('nextNum'));
    }

    public function electric_gas() {
        $nextNum = $this->getNextApplicationNumber();
        return view('backend.new-application.utilities_services.electric_gas', compact('nextNum'));
    }

    public function applications() {
        $applications = Application::latest()->get();
        return view('backend.applications.applications', compact('applications'));
    }

    private function normalizeServiceType(?string $serviceType): string
    {
        $value = strtolower(trim((string) $serviceType));
        return match ($value) {
            'card machine', 'card_machine' => 'Card Machine',
            'loan' => 'Loan',
            'open banking', 'open_banking' => 'Open Banking',
            'water' => 'Water',
            'broadband' => 'Broadband',
            'telecom' => 'Telecom',
            'gas' => 'Gas',
            'electricity' => 'Electricity',
            'electric gas', 'electric_gas' => 'Electric Gas',
            default => $serviceType ?: '',
        };
    }

    private function getValidationRules(string $serviceType): array
    {
        $rules = [
            'application_agent' => ['required', 'string', 'max:255'],
            'service_type' => ['required', 'string'],
            'application_num' => ['required', 'string', 'max:255'],
            'application_date' => ['required', 'date'],
        ];

        switch ($serviceType) {
            case 'Card Machine':
                $rules += $this->financeCommonRules();
                $rules += [
                    'qty' => ['required', 'integer', 'min:1'],
                    'director_name' => ['required', 'array', 'min:1'],
                    'director_name.*' => ['required', 'string', 'max:255'],
                    'director_dob_array' => ['required', 'array', 'min:1'],
                    'director_dob_array.*' => ['required', 'date'],
                    'director_phone' => ['required', 'array', 'min:1'],
                    'director_phone.*' => ['required', 'string', 'max:255'],
                    'director_email' => ['required', 'array', 'min:1'],
                    'director_email.*' => ['required', 'email', 'max:255'],
                    'director_home_address' => ['required', 'array', 'min:1'],
                    'director_home_address.*' => ['required', 'string'],
                ];
                break;

            case 'Loan':
                $rules += $this->financeCommonRules();
                break;

            case 'Open Banking':
                $rules += [
                    'title' => ['required', 'string', 'max:50'],
                    'merchant_full_name' => ['required', 'string', 'max:255'],
                    'first_name' => ['required', 'string', 'max:255'],
                    'last_name' => ['required', 'string', 'max:255'],
                    'email_address' => ['required', 'email', 'max:255'],
                    'mobile_no' => ['required', 'string', 'max:255'],
                    'companies_house_number' => ['required', 'string', 'max:255'],
                    'business_address' => ['required', 'string'],
                    'renewal_date' => ['required', 'date'],
                    'brand' => ['required', 'string', 'max:255'],
                ];
                break;

            case 'Water':
            case 'Broadband':
            case 'Telecom':
                $rules += [
                    'company_name' => ['required', 'string', 'max:255'],
                    'landline_no' => ['required', 'string', 'max:255'],
                    'contact_person_name' => ['required', 'string', 'max:255'],
                    'company_reg_no' => ['required', 'string', 'max:255'],
                    'business_address' => ['required', 'string'],
                    'email_address' => ['required', 'email', 'max:255'],
                    'unit' => ['required', 'string', 'max:255'],
                    'home_address' => ['required', 'string'],
                    'director_dob_single' => ['required', 'date'],
                    'mobile_no' => ['required', 'string', 'max:255'],
                    'brand' => ['required', 'string', 'max:255'],
                ];
                if ($serviceType === 'Water') {
                    $rules['spid'] = ['required', 'numeric'];
                }
                break;

            case 'Gas':
            case 'Electricity':
            case 'Electric Gas':
                $rules += [
                    'company_name' => ['required', 'string', 'max:255'],
                    'trading_name' => ['required', 'string', 'max:255'],
                    'business_entity' => ['required', 'string', 'max:255'],
                    'business_nature' => ['required', 'string', 'max:255'],
                    'title' => ['required', 'string', 'max:50'],
                    'merchant_full_name' => ['required', 'string', 'max:255'],
                    'position' => ['required', 'string', 'max:255'],
                    'email_address' => ['required', 'email', 'max:255'],
                    'phone_number' => ['required', 'string', 'max:255'],
                    'companies_house_number' => ['required', 'string', 'max:255'],
                    'vat_tax_number' => ['required', 'string', 'max:255'],
                    'trading_address' => ['required', 'string'],
                    'postal_code' => ['required', 'string', 'max:255'],
                    'annual_consumption' => ['required', 'string', 'max:255'],
                    'renewal_date' => ['required', 'date'],
                    'utility_email' => ['required', 'email', 'max:255'],
                    'company_reg_no' => ['required', 'string', 'max:255'],
                    'commercial_resident' => ['required', 'string', 'max:255'],
                    'brand' => ['required', 'string', 'max:255'],
                ];
                break;
        }

        return $rules;
    }

    private function financeCommonRules(): array
    {
        return [
            'company_name' => ['required', 'string', 'max:255'],
            'trading_name' => ['required', 'string', 'max:255'],
            'business_entity' => ['required', 'string', 'max:255'],
            'business_nature' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:50'],
            'merchant_full_name' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'email_address' => ['required', 'email', 'max:255'],
            'phone_number' => ['required', 'string', 'max:255'],
            'companies_house_number' => ['required', 'string', 'max:255'],
            'vat_tax_number' => ['required', 'string', 'max:255'],
            'trading_address' => ['required', 'string'],
            'renewal_date' => ['required', 'date'],
            'brand' => ['required', 'string', 'max:255'],
        ];
    }

    private function prepareRequestData(Request $request): array
    {
        $data = $request->all();

        $serviceType = $this->normalizeServiceType($request->input('service_type'));
        $data['service_type'] = $serviceType;

        $aliases = [
            'email' => 'email_address',
            'full_name' => 'merchant_full_name',
            'business_number' => 'companies_house_number',
            'phone' => 'phone_number',
            'director_dob' => 'director_dob_single',
            'company_registration_no' => 'company_reg_no',
            'gas_email' => 'utility_email',
            'electric_email' => 'utility_email',
            'bank_name' => 'name_of_bank',
            'bill' => 'bill_upload',
            'account_name' => 'name_on_account',
        ];

        foreach ($aliases as $from => $to) {
            if (!isset($data[$to]) && $request->filled($from)) {
                $data[$to] = $request->input($from);
            }
        }

        if (!isset($data['director_dob_array']) && isset($data['director_dob']) && is_array($data['director_dob'])) {
            $data['director_dob_array'] = $data['director_dob'];
        }

        if (!isset($data['director_home_address']) && isset($data['director_address']) && is_array($data['director_address'])) {
            $data['director_home_address'] = $data['director_address'];
        }

        return $data;
    }

    public function store(Request $request)
    {
        $prepared = $this->prepareRequestData($request);
        $serviceType = $prepared['service_type'] ?? '';
        $validated = validator($prepared, $this->getValidationRules($serviceType))->validate();

        DB::beginTransaction();
        try {
            $application = new Application();
            $this->fillApplication($application, $request, $prepared, true);
            $application->save();

            $this->syncDirectors($application, $prepared);
            $this->syncMeters($application, $prepared);

            DB::commit();
            return back()->with('success', 'Application Submitted Successfully!');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $application = Application::with('directors', 'meters')->findOrFail($id);
        return view('backend.applications.edit', compact('application'));
    }

    public function update(Request $request, $id)
    {
        $prepared = $this->prepareRequestData($request);
        $serviceType = $prepared['service_type'] ?? '';
        validator($prepared, $this->getValidationRules($serviceType))->validate();

        DB::beginTransaction();
        try {
            $application = Application::findOrFail($id);
            $this->fillApplication($application, $request, $prepared, false);
            $application->save();

            $application->directors()->delete();
            $application->meters()->delete();

            $this->syncDirectors($application, $prepared);
            $this->syncMeters($application, $prepared);

            DB::commit();
            return back()->with('success', 'Application Updated Successfully!');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $app = Application::findOrFail($id);
        $app->delete();
        return back()->with('success', 'Application Deleted Successfully!');
    }

    private function fillApplication(Application $app, Request $request, array $data, bool $isCreate): void
    {
        $fields = [
            'application_agent', 'application_num', 'service_type',
            'company_name', 'trading_name', 'business_entity', 'business_nature',
            'title', 'merchant_full_name', 'first_name', 'last_name', 'position',
            'email_address', 'phone_number', 'mobile_no', 'landline_no', 'contact_person_name',
            'companies_house_number', 'company_reg_no', 'vat_tax_number',
            'trading_address', 'business_address', 'unit', 'home_address', 'postal_code',
            'director_dob_single', 'application_date', 'renewal_date', 'brand',
            'card_machine_details', 'existing_funding', 'annual_consumption', 'utility_email',
            'commercial_resident', 'spid', 'qty', 'delivery_address', 'comment',
            'debit_card', 'credit_card', 'commercial_card', 'authentication_fee', 'pci', 'rental',
            'name_on_account', 'account_number', 'sort_code', 'iban', 'bic', 'name_of_bank',
            'bill_payment_method', 'landlord_name', 'name_of_new_customer', 'status_taken_date',
            'password', 'customer_history',
        ];

        foreach ($fields as $field) {
            $app->{$field} = $data[$field] ?? null;
        }

        $app->epos_system = $request->boolean('epos_system');

        $this->handleFile($request, $app, 'picture_id', $isCreate);
        $this->handleFile($request, $app, 'inside_outside_pics', $isCreate);
        $this->handleFile($request, $app, 'bill_upload', $isCreate, ['bill']);
        $this->handleFile($request, $app, 'bank_statement', $isCreate);
        $this->handleFile($request, $app, 'additional_uploads', $isCreate);
    }

    private function handleFile(Request $request, Application $app, string $field, bool $isCreate, array $aliases = []): void
    {
        $allNames = array_merge([$field], $aliases);
        foreach ($allNames as $name) {
            if ($request->hasFile($name)) {
                if (!$isCreate && !empty($app->{$field})) {
                    Storage::disk('public')->delete($app->{$field});
                }
                $app->{$field} = $request->file($name)->store('kyc', 'public');
                return;
            }
        }
    }

    private function syncDirectors(Application $application, array $data): void
    {
        $names = $data['director_name'] ?? [];
        if (!is_array($names)) {
            return;
        }

        $dobs = $data['director_dob_array'] ?? [];
        $phones = $data['director_phone'] ?? [];
        $emails = $data['director_email'] ?? [];
        $addresses = $data['director_home_address'] ?? [];

        foreach ($names as $index => $name) {
            if (blank($name)) {
                continue;
            }

            ApplicationDirector::create([
                'application_id' => $application->id,
                'director_name' => $name,
                'date_of_birth' => $dobs[$index] ?? null,
                'phone_no' => $phones[$index] ?? null,
                'email_address' => $emails[$index] ?? null,
                'home_address' => $addresses[$index] ?? null,
            ]);
        }
    }

 private function syncMeters(Application $application, array $data): void
{
    $meters = [];

    if (!empty($data['meters']) && is_array($data['meters'])) {
        foreach ($data['meters'] as $meter) {
            if (!is_array($meter)) continue;

            $meters[] = array_merge(
                ['meter_type' => 'gas'],
                $this->mapMeterFields($meter)
            );
        }
    }
    if (!empty($data['elec_meters']) && is_array($data['elec_meters'])) {
        foreach ($data['elec_meters'] as $meter) {
            if (!is_array($meter)) continue;

            $meters[] = array_merge(
                ['meter_type' => 'electricity'],
                $this->mapMeterFields($meter)
            );
        }
    }

    // ✅ SAVE
    foreach ($meters as $meterData) {
        foreach ($meterData as $key => $value) {
            if (is_array($value)) {
                $meterData[$key] = implode(', ', $value);
            }
        }

        ApplicationMeter::create(array_merge([
            'application_id' => $application->id
        ], $meterData));
    }
}

// Helper function for structured data
    private function mapMeterFields(array $meter): array {
        return [
            'meter_type'           => $meter['meter_type'] ?? null,
            'supplier_name'        => $meter['supplier_name'] ?? null,
            'mpan_top'             => $meter['mpan_top'] ?? ($meter['mpan_top_line'] ?? null),
            'mpan_bottom'          => $meter['mpan_bottom'] ?? ($meter['mpan_bottom_line'] ?? null),
            'mprn_no'              => $meter['mprn_no'] ?? null,
            'offer_rate'           => $meter['offer_rate'] ?? null,
            'contract_duration'    => $meter['contract_duration'] ?? ($meter['con_duration'] ?? null),
            'uplift'               => $meter['uplift'] ?? null,
            'customer_no'          => $meter['customer_no'] ?? null,
            'name_appears_on_bill' => $meter['name_appears_on_bill'] ?? ($meter['bill_name'] ?? ($meter['name_on_bill'] ?? null)),
            'current_meter_read'   => $meter['current_meter_read'] ?? null,
            'meter_serial_no'      => $meter['meter_serial_no'] ?? null,
            'last_bill_amount'     => $meter['last_bill_amount'] ?? null,
            'mode'                 => $meter['mode'] ?? null,
        ];
    }

    private function getNextApplicationNumber(): string
    {
        $lastApplication = Application::latest('id')->first();

        if (!$lastApplication || empty($lastApplication->application_num)) {
            return 'APP-001';
        }

        $number = preg_replace('/[^0-9]/', '', (string) $lastApplication->application_num);
        return 'APP-' . str_pad(((int) $number) + 1, 3, '0', STR_PAD_LEFT);
    }

public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => ['string', 'max:50']
    ]);

    $application = Application::findOrFail($id);
    $application->status = $request->status;
    $application->save();

    return response()->json([
        'success' => true,
        'message' => 'Status updated successfully'
    ]);
}

}
