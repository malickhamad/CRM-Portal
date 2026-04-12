<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\ApplicationDirector;
use App\Models\ApplicationMeter;
use Illuminate\Support\Facades\DB;

class ApplicationController extends Controller
{
    public function services() {
        return view('backend.new-application.services');
    }
    public function finance_services() {
        return view('backend.new-application.finance_services');
    }
    public function utilities_services() {
        return view('backend.new-application.utilities_services');
    }
    public function card_machine() {
        $nextNum = $this->getNextApplicationNumber();
        return view('backend.new-application.finance_services.card_machine', compact('nextNum'));
    }
    public function loan() {
        return view('backend.new-application.finance_services.loan');
    }
    public function open_banking() {
        return view('backend.new-application.finance_services.open_banking');
    }

    // Utilities Services Pages
    public function water() {
        return view('backend.new-application.utilities_services.water');
    }
    public function broadband() {
        return view('backend.new-application.utilities_services.broadband');
    }
    public function telecom() {
        return view('backend.new-application.utilities_services.telecom');
    }
    public function gas() {
        return view('backend.new-application.utilities_services.gas');
    }
    public function electricity() {
        return view('backend.new-application.utilities_services.electricity');
    }
    public function electric_gas() {
        return view('backend.new-application.utilities_services.electric_gas');
    }

    public function applications() {
        $applications = Application::latest()->get();
        return view('backend.applications.applications', compact('applications'));
    }

    // ====== DYNAMIC VALIDATION LOGIC ======
    private function getValidationRules($serviceType)
    {
        // Base rules jo har form me required hain
        $rules = [
            'application_agent' => 'required|string|max:255',
            'service_type'      => 'required|string',
            'application_num'   => 'required|string',
            'application_date'  => 'required|date',
        ];

        // Service ke hisaab se rules dynamically add karein
        switch ($serviceType) {
            case 'Card Machine':
            case 'Loan':
                $rules += [
                    'company_name'           => 'required|string|max:255',
                    'trading_name'           => 'required|string|max:255',
                    'business_entity'        => 'required|string',
                    'business_nature'        => 'required|string',
                    'title'                  => 'required|string',
                    'merchant_full_name'     => 'required|string|max:255',
                    'position'               => 'required|string',
                    'email_address'          => 'required|email',
                    'phone_number'           => 'required|string',
                    'companies_house_number' => 'required|string',
                    'vat_tax_number'         => 'required|string',
                    'trading_address'        => 'required|string',
                    'brand'                  => 'required|string',
                    'renewal_date'           => 'required|date',
                ];
                if($serviceType == 'Card Machine') {
                    $rules['qty'] = 'required|integer|min:1';
                    // Directors Array Validation
                    $rules['director_name.*']         = 'required|string';
                    $rules['director_dob_array.*']    = 'required|date';
                    $rules['director_phone.*']        = 'required|string';
                    $rules['director_email.*']        = 'required|email';
                    $rules['director_home_address.*'] = 'required|string';
                }
                break;

            case 'Open Banking':
                $rules += [
                    'title'                  => 'required|string',
                    'merchant_full_name'     => 'required|string|max:255',
                    'first_name'             => 'required|string|max:255',
                    'last_name'              => 'required|string|max:255',
                    'email_address'          => 'required|email',
                    'mobile_no'              => 'required|string',
                    'companies_house_number' => 'required|string',
                    'business_address'       => 'required|string',
                    'brand'                  => 'required|string',
                    'renewal_date'           => 'required|date',
                ];
                break;

            case 'Water':
            case 'Broadband':
            case 'Telecom':
                $rules += [
                    'company_name'        => 'required|string|max:255',
                    'landline_no'         => 'required|string',
                    'contact_person_name' => 'required|string|max:255',
                    'company_reg_no'      => 'required|string',
                    'business_address'    => 'required|string',
                    'email_address'       => 'required|email',
                    'unit'                => 'required|string',
                    'home_address'        => 'required|string',
                    'director_dob_single' => 'required|date',
                    'mobile_no'           => 'required|string',
                    'brand'               => 'required|string',
                ];
                if($serviceType == 'Water') {
                    $rules['spid'] = 'required|numeric';
                }
                break;

            case 'Gas':
            case 'Electricity':
            case 'Electric Gas':
                $rules += [
                    'company_name'           => 'required|string|max:255',
                    'trading_name'           => 'required|string|max:255',
                    'business_entity'        => 'required|string',
                    'business_nature'        => 'required|string',
                    'title'                  => 'required|string',
                    'merchant_full_name'     => 'required|string|max:255',
                    'position'               => 'required|string',
                    'email_address'          => 'required|email',
                    'phone_number'           => 'required|string',
                    'companies_house_number' => 'required|string',
                    'vat_tax_number'         => 'required|string',
                    'trading_address'        => 'required|string',
                    'postal_code'            => 'required|string',
                    'annual_consumption'     => 'required|string',
                    'renewal_date'           => 'required|date',
                    'utility_email'          => 'required|email',
                    'company_reg_no'         => 'required|string',
                    'commercial_resident'    => 'required|string',
                    'brand'                  => 'required|string',
                ];
                break;
        }

        return $rules;
    }


    public function store(Request $request)
    {
        // 1. DYNAMIC VALIDATION CHECK
        // Agar service_type hidden field me nahi aayi to validation wahi ruk jayegi
        $rules = $this->getValidationRules($request->input('service_type'));

        $validatedData = $request->validate($rules, [
            'qty.required' => 'The quantity field is required for Card Machine.',
            'director_name.*.required' => 'Each director must have a name.',
            // Aap yahan custom messages add kar sakte hain agr chahain
        ]);

        DB::beginTransaction();
        try {

            $app = new Application();

            // Core & Customer Detail
            $app->application_agent = $request->application_agent;
            $app->application_num = $request->application_num ?? 'APP-' . time();
            $app->service_type = $request->service_type; // Isko blade mein readonly/hidden field se bhejein

            $app->company_name = $request->company_name;
            $app->trading_name = $request->trading_name;
            $app->business_entity = $request->business_entity;
            $app->business_nature = $request->business_nature;
            $app->title = $request->title;
            $app->merchant_full_name = $request->merchant_full_name;
            $app->first_name = $request->first_name;
            $app->last_name = $request->last_name;
            $app->position = $request->position;
            $app->email_address = $request->email_address;
            $app->phone_number = $request->phone_number;
            $app->mobile_no = $request->mobile_no;
            $app->landline_no = $request->landline_no;
            $app->contact_person_name = $request->contact_person_name;
            $app->companies_house_number = $request->companies_house_number;
            $app->company_reg_no = $request->company_reg_no;
            $app->vat_tax_number = $request->vat_tax_number;
            $app->trading_address = $request->trading_address;
            $app->business_address = $request->business_address;
            $app->unit = $request->unit;
            $app->home_address = $request->home_address;
            $app->postal_code = $request->postal_code;
            $app->director_dob_single = $request->director_dob_single;

            // App Specific Details
            $app->application_date = $request->application_date;
            $app->renewal_date = $request->renewal_date;
            $app->brand = $request->brand;
            $app->card_machine_details = $request->card_machine_details;
            $app->existing_funding = $request->existing_funding;
            $app->annual_consumption = $request->annual_consumption;
            // Dheyan rakhein form me 'electric_email', 'gas_email' ki jaga name="utility_email" rakhein
            $app->utility_email = $request->utility_email ?? $request->electric_email ?? $request->gas_email;
            $app->commercial_resident = $request->commercial_resident;
            $app->spid = $request->spid;
            $app->qty = $request->qty;
            $app->delivery_address = $request->delivery_address;
            $app->epos_system = $request->has('epos_system') ? 1 : 0;
            $app->comment = $request->comment;

            // Monthly Rental (Card Machine)
            $app->debit_card = $request->debit_card;
            $app->credit_card = $request->credit_card;
            $app->commercial_card = $request->commercial_card;
            $app->authentication_fee = $request->authentication_fee;
            $app->pci = $request->pci;
            $app->rental = $request->rental;

            // Bank Details
            $app->name_on_account = $request->name_on_account;
            $app->account_number = $request->account_number;
            $app->sort_code = $request->sort_code;
            $app->iban = $request->iban;
            $app->bic = $request->bic;
            $app->name_of_bank = $request->name_of_bank;

            // Other Details
            $app->bill_payment_method = $request->bill_payment_method;
            $app->landlord_name = $request->landlord_name;
            $app->name_of_new_customer = $request->name_of_new_customer;
            $app->status_taken_date = $request->status_taken_date;
            $app->password = $request->password;
            $app->customer_history = $request->customer_history;

            // --- FILE UPLOADS (KYC) ---
            if ($request->hasFile('picture_id')) {
                $app->picture_id = $request->file('picture_id')->store('kyc', 'public');
            }
            if ($request->hasFile('inside_outside_pics')) {
                $app->inside_outside_pics = $request->file('inside_outside_pics')->store('kyc', 'public');
            }
            if ($request->hasFile('bill_upload')) {
                $app->bill_upload = $request->file('bill_upload')->store('kyc', 'public');
            }
            if ($request->hasFile('bank_statement')) {
                $app->bank_statement = $request->file('bank_statement')->store('kyc', 'public');
            }
            if ($request->hasFile('additional_uploads')) {
                $app->additional_uploads = $request->file('additional_uploads')->store('kyc', 'public');
            }

            $app->save(); // Main table saved

            // 2. SAVE DIRECTORS
            if ($request->has('director_name') && is_array($request->director_name)) {
                foreach ($request->director_name as $key => $name) {
                    if (!empty($name)) {
                        ApplicationDirector::create([
                            'application_id' => $app->id,
                            'director_name'  => $name,
                            'date_of_birth'  => $request->director_dob_array[$key] ?? null,
                            'phone_no'       => $request->director_phone[$key] ?? null,
                            'email_address'  => $request->director_email[$key] ?? null,
                            'home_address'   => $request->director_home_address[$key] ?? null,
                        ]);
                    }
                }
            }

            // 3. SAVE METERS
            if ($request->has('supplier_name') && is_array($request->supplier_name)) {
                foreach ($request->supplier_name as $key => $supplier) {
                    if (!empty($supplier)) {
                        ApplicationMeter::create([
                            'application_id'       => $app->id,
                            'meter_type'           => $request->meter_type[$key] ?? null,
                            'supplier_name'        => $supplier,
                            'mpan_top'             => $request->mpan_top[$key] ?? null,
                            'mpan_bottom'          => $request->mpan_bottom[$key] ?? null,
                            'mprn_no'              => $request->mprn_no[$key] ?? null,
                            'offer_rate'           => $request->offer_rate[$key] ?? null,
                            'contract_duration'    => $request->contract_duration[$key] ?? null,
                            'uplift'               => $request->uplift[$key] ?? null,
                            'customer_no'          => $request->customer_no[$key] ?? null,
                            'name_appears_on_bill' => $request->name_appears_on_bill[$key] ?? null,
                            'current_meter_read'   => $request->current_meter_read[$key] ?? null,
                            'meter_serial_no'      => $request->meter_serial_no[$key] ?? null,
                            'last_bill_amount'     => $request->last_bill_amount[$key] ?? null,
                            'mode'                 => $request->mode[$key] ?? null,
                        ]);
                    }
                }
            }

            DB::commit();
            return back()->with('success', 'Application Submitted Successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $application = Application::with('directors', 'meters')->findOrFail($id);
        return view('backend.applications.edit', compact('application'));
    }

    public function update(Request $request, $id)
    {
        // Validation during update
        $rules = $this->getValidationRules($request->input('service_type'));
        $validatedData = $request->validate($rules);

        $app = Application::findOrFail($id);

        // Remove old dynamic fields data
        $app->directors()->delete();
        $app->meters()->delete();

        // Aap yahan same store wala logic apply kar k db me save kar lein
        // ...

        return back()->with('success', 'Application Updated Successfully!');
    }

    public function destroy($id)
    {
        $app = Application::findOrFail($id);
        $app->delete();
        return back()->with('success', 'Application Deleted Successfully!');
    }

    private function getNextApplicationNumber() {
        $lastApplication = Application::latest('id')->first();
        if (!$lastApplication) {
            return "001";
        } else {
            $number = preg_replace('/[^0-9]/', '', $lastApplication->application_num);
            return "AUTO-" . str_pad((int)$number + 1, 3, '0', STR_PAD_LEFT);
        }
    }
}




