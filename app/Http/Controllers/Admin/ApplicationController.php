<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\ApplicationDirector;
use App\Models\ApplicationMeter;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class ApplicationController extends Controller
{

   private function getCommonStats()
{
    $query = Application::query();

    if (!auth()->user()->hasRole('Admin')) {
        $query->where('user_id', auth()->id());
    }

    return [
        'remainingLeads' => (clone $query)
            ->whereNotIn('status', ['Paid', 'Rejected', 'Live'])
            ->count(),

        'allSales' => (clone $query)
            ->whereIn('status', ['Live', 'Paid'])
            ->count(),

        'thisMonthSales' => (clone $query)
            ->whereIn('status', ['Live', 'Paid'])
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count(),

        'todayApplications' => (clone $query)
            ->whereDate('created_at', today())
            ->count(),

        'thisWeekApplications' => (clone $query)
            ->whereBetween('created_at', [
                now()->startOfWeek(),
                now()->endOfWeek()
            ])
            ->count(),

        'thisMonthApplications' => (clone $query)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count(),

        'allApplications' => (clone $query)
            ->count(),
    ];
}

    private function viewWithStats($view, $data = [])
    {
        return view($view, array_merge($data, $this->getCommonStats()));
    }

    public function services()
    {
        return view('backend.new-application.services', $this->getCommonStats());
    }

    public function finance_services()
    {
        return view('backend.new-application.finance_services', $this->getCommonStats());
    }

    public function utilities_services()
    {
        return view('backend.new-application.utilities_services', $this->getCommonStats());
    }
    public function card_machine()
    {
        $nextNum = $this->getNextApplicationNumber();
        return view('backend.new-application.finance_services.card_machine', array_merge(
            ['nextNum' => $nextNum],
            $this->getCommonStats()
        ));
    }

    public function loan()
    {
        $nextNum = $this->getNextApplicationNumber();
        return view('backend.new-application.finance_services.loan', array_merge(
            ['nextNum' => $nextNum],
            $this->getCommonStats()
        ));
    }

    public function open_banking()
    {
        $nextNum = $this->getNextApplicationNumber();
        return view('backend.new-application.finance_services.open_banking', array_merge(
            ['nextNum' => $nextNum],
            $this->getCommonStats()
        ));
    }

    public function water()
    {
        $nextNum = $this->getNextApplicationNumber();
        return view('backend.new-application.utilities_services.water', array_merge(
            ['nextNum' => $nextNum],
            $this->getCommonStats()
        ));
    }

    public function broadband()
    {
        $nextNum = $this->getNextApplicationNumber();
        return view('backend.new-application.utilities_services.broadband', array_merge(
            ['nextNum' => $nextNum],
            $this->getCommonStats()
        ));
    }

    public function telecom()
    {
        $nextNum = $this->getNextApplicationNumber();
        return view('backend.new-application.utilities_services.telecom', array_merge(
            ['nextNum' => $nextNum],
            $this->getCommonStats()
        ));
    }

    public function gas()
    {
        $nextNum = $this->getNextApplicationNumber();
        return view('backend.new-application.utilities_services.gas', array_merge(
            ['nextNum' => $nextNum],
            $this->getCommonStats()
        ));
    }

    public function electricity()
    {
        $nextNum = $this->getNextApplicationNumber();
        return view('backend.new-application.utilities_services.electricity', array_merge(
            ['nextNum' => $nextNum],
            $this->getCommonStats()
        ));
    }

    public function electric_gas()
    {
        $nextNum = $this->getNextApplicationNumber();
        return view('backend.new-application.utilities_services.electric_gas', array_merge(
            ['nextNum' => $nextNum],
            $this->getCommonStats()
        ));
    }
    public function applications(Request $request)
{
    $selectedUserId = $request->user_id;

    $baseQuery = Application::query();

    if (!auth()->user()->hasRole('Admin')) {
        $baseQuery->where('user_id', auth()->id());
        $selectedUserId = auth()->id();
    } elseif (!empty($selectedUserId)) {
        $baseQuery->where('user_id', $selectedUserId);
    }

    $applications = (clone $baseQuery)
        ->with(['user', 'comments.user'])
        ->latest()
        ->get();

    $pendingApplications = (clone $baseQuery)
        ->whereNotIn('status', ['Paid', 'Rejected', 'Live'])
        ->count();

    $completedApplications = (clone $baseQuery)
        ->whereIn('status', ['Live', 'Paid'])
        ->count();

    $rejectedApplications = (clone $baseQuery)
        ->where('status', 'Rejected')
        ->count();

     $liveApplications = (clone $baseQuery)
    ->where('status', 'Live')
    ->count();

    $users = \App\Models\User::orderBy('name')->get(['id', 'name']);

    return view('backend.applications.applications', compact(
        'applications',
        'pendingApplications',
        'completedApplications',
        'rejectedApplications',
        'liveApplications',
        'users',
        'selectedUserId'
    ));
}


        public function deleteFile(Request $request, $id)
        {
            $application = Application::findOrFail($id);

            $fileToDelete = trim($request->file);


            // Delete physical file
            if(Storage::disk('public')->exists($fileToDelete)){
                Storage::disk('public')->delete($fileToDelete);
            }


            // Columns where files are stored
            $fileColumns = [
                'picture_id',
                'inside_outside_pics',
                'bill_upload',
                'bank_statement',
                'additional_uploads',
                'meter_pictures'
            ];


            foreach($fileColumns as $column){

                if(!empty($application->$column)){

                    $files = array_filter(explode(',', $application->$column));


                    // Remove deleted file path
                    $files = array_filter($files, function($file) use ($fileToDelete){
                        return trim($file) !== $fileToDelete;
                    });


                    // Update column
                    $application->$column = !empty($files)
                        ? implode(',', $files)
                        : null;
                }
            }


            $application->save();


            return response()->json([
                'success' => true,
                'message' => 'File deleted successfully'
            ]);
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
            'sale_closer' => ['required', 'string', 'max:255'],
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
        // dd($request->all());
        $prepared = $this->prepareRequestData($request);
        $serviceType = $prepared['service_type'] ?? '';
        // $validated = validator($prepared, $this->getValidationRules($serviceType))->validate();

        DB::beginTransaction();
        try {
            $application = new Application();
            $this->fillApplication($application, $request, $prepared, true);
            $application->save();

            $this->syncDirectors($application, $prepared);
            $this->syncMeters($application, $prepared);

            DB::commit();

             // Activity log for creating the application
            activity()
            ->causedBy(Auth::user())
            ->performedOn($application)
            ->log("Created application: {$application->application_num}");


            return back()->with('success', 'Application Submitted Successfully!');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Failed to submit application.');
        }
    }


   public function edit($id)
{
    $application = Application::with('directors', 'meters')->findOrFail($id);
    $serviceType = $this->normalizeServiceType($application->service_type);

    // Fetch only the meters associated with the application
    $meters = $application->meters;

    // Now filter the meters based on their type
    $gasMeters = $meters->where('meter_type', 'gas')->values();
    $electricityMeters = $meters->where('meter_type', 'electricity')->values();

    $view = match ($serviceType) {
        'Card Machine' => 'backend.applications.edit.card_machine',
        'Loan' => 'backend.applications.edit.loan',
        'Open Banking' => 'backend.applications.edit.open_banking',
        'Water' => 'backend.applications.edit.water',
        'Broadband' => 'backend.applications.edit.broadband',
        'Telecom' => 'backend.applications.edit.telecom',
        'Gas' => 'backend.applications.edit.gas',
        'Electricity' => 'backend.applications.edit.electricity',
        'Electric Gas' => 'backend.applications.edit.electric_gas',
        default => 'backend.applications.edit.loan',
    };

    return view($view, array_merge(
        ['application' => $application, 'gasMeters' => $gasMeters, 'electricityMeters' => $electricityMeters],
        $this->getCommonStats()
    ));
}


    public function update(Request $request, $id)
    {
        // Fetch the application record based on the provided ID
        $application = Application::with('directors', 'meters')->findOrFail($id);

        // Handle the date formatting for director's date of birth and other date fields
        $firstDirector = $application->directors->first();
        $directorDob = $firstDirector ? Carbon::parse($firstDirector->date_of_birth) : null;
        $renewalDate = Carbon::parse($application->renewal_date)->format('Y-m-d');
        $applicationDate = Carbon::parse($application->application_date)->format('Y-m-d');
        $singledirectordob = Carbon::parse($application->director_dob_single)->format('Y-m-d');
        $statustakendate = Carbon::parse($application->status_taken_date)->format('Y-m-d');

        // Prepare the data for validation
        $prepared = $this->prepareRequestData($request);

        // Get the service type from the request and validate
        $serviceType = $prepared['service_type'] ?? '';
        // validator($prepared, $this->getValidationRules($serviceType))->validate();

        DB::beginTransaction();
        try {
            // Update the application with the new data
            $this->fillApplication($application, $request, $prepared, false);
            $application->save();

            // Sync directors and meters (this is important for updating the application data)
            $application->directors()->delete(); // Delete existing directors first
            $application->meters()->delete(); // Delete existing meters first
            $this->syncDirectors($application, $prepared);
            $this->syncMeters($application, $prepared);

            DB::commit();

               // Activity log for updating the application
        activity()
            ->causedBy(Auth::user())
            ->performedOn($application)
            ->log("Updated application: {$application->application_num}");

            // Redirect back with success message
            return back()->with('sweetalert', [
                'type' => 'success',
                'title' => 'Success',
                'message' => 'Application Updated Successfully!',
            ]);
        } catch (\Throwable $e) {
            // In case of error, roll back the transaction and show error message
            DB::rollBack();
            return back()->withInput()->with('sweetalert', [
                'type' => 'error',
                'title' => 'Error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function destroy($id)
    {
        $app = Application::findOrFail($id);

          // Activity log for deleting the application
          activity()
        ->causedBy(Auth::user())
        ->performedOn($app)
        ->log("Deleted application: {$app->application_num}");


        $app->delete();
        return back()->with('success', 'Application Deleted Successfully!');
    }

    private function fillApplication(Application $app, Request $request, array $data, bool $isCreate): void
    {
        if ($isCreate) {
            $app->user_id = auth()->id();
        }

        $fields = [
            'application_agent',
            'sale_closer',
            'application_num',
            'service_type',
            'company_name',
            'trading_name',
            'business_entity',
            'business_nature',
            'title',
            'merchant_full_name',
            'first_name',
            'last_name',
            'position',
            'email_address',
            'phone_number',
            'mobile_no',
            'landline_no',
            'contact_person_name',
            'companies_house_number',
            'company_reg_no',
            'vat_tax_number',
            'trading_address',
            'business_address',
            'unit',
            'home_address',
            'postal_code',
            'director_dob_single',
            'application_date',
            'renewal_date',
            'brand',
            'card_machine_details',
            'existing_funding',
            'annual_consumption',
            'utility_email',
            'commercial_resident',
            'spid',
            'qty',
            'delivery_address',
            'comment',
            'debit_card',
            'credit_card',
            'commercial_card',
            'authentication_fee',
            'pci',
            'rental',
            'name_on_account',
            'account_number',
            'sort_code',
            'iban',
            'bic',
            'name_of_bank',
            'bill_payment_method',
            'landlord_name',
            'name_of_new_customer',
            'status_taken_date',
            'password',
            'customer_history',
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
        $this->handleFile($request, $app, 'meter_pictures', $isCreate);
    }

    // private function handleFile(Request $request, Application $app, string $field, bool $isCreate, array $aliases = []): void
    // {
    //     $allNames = array_merge([$field], $aliases);
    //     foreach ($allNames as $name) {
    //         if ($request->hasFile($name)) {
    //             if (!$isCreate && !empty($app->{$field})) {
    //                 Storage::disk('public')->delete($app->{$field});
    //             }
    //             // $app->{$field} = $request->file($name)->store('kyc', 'public');
                
    //             //   dd($request->file($name));
    //       $file = $request->file($name);

    //         if (is_array($file)) {

    //             $files = [];

    //             foreach ($file as $item) {
    //                 $files[] = $item->store('kyc', 'public');
    //             }

    //             $app->{$field} = implode(',', $files);

    //         } else {

    //             $app->{$field} = $file->store('kyc', 'public');

    //         }



    //             return;
    //         }
    //     }
    // }




    private function handleFile(Request $request, Application $app, string $field, bool $isCreate, array $aliases = []): void
{
    $allNames = array_merge([$field], $aliases);

    foreach ($allNames as $name) {

        if ($request->hasFile($name)) {

            $file = $request->file($name);

            $newFiles = [];


            $files = is_array($file) ? $file : [$file];


            foreach ($files as $item) {

                $originalName = $item->getClientOriginalName();

               $uniqueName = $originalName;


                $path = $item->storeAs(
                    'kyc',
                    $uniqueName,
                    'public'
                );


                $newFiles[] = $path;
            }


            // Keep old files
            $oldFiles = [];

            if (!$isCreate && !empty($app->{$field})) {
                $oldFiles = explode(',', $app->{$field});
            }


            $app->{$field} = implode(',', array_merge($oldFiles, $newFiles));


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
                if (!is_array($meter))
                    continue;

                $meters[] = array_merge(
                    ['meter_type' => 'gas'],
                    $this->mapMeterFields($meter)
                );
            }
        }
        if (!empty($data['elec_meters']) && is_array($data['elec_meters'])) {
            foreach ($data['elec_meters'] as $meter) {
                if (!is_array($meter))
                    continue;

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
    private function mapMeterFields(array $meter): array
    {
        return [
            'meter_type' => $meter['meter_type'] ?? null,
            'supplier_name' => $meter['supplier_name'] ?? null,
            'mpan_top' => $meter['mpan_top'] ?? ($meter['mpan_top_line'] ?? null),
            'mpan_bottom' => $meter['mpan_bottom'] ?? ($meter['mpan_bottom_line'] ?? null),
            'mprn_no' => $meter['mprn_no'] ?? null,
            'offer_rate' => $meter['offer_rate'] ?? null,
            'contract_duration' => $meter['contract_duration'] ?? ($meter['con_duration'] ?? null),
            'uplift' => $meter['uplift'] ?? null,
            'customer_no' => $meter['customer_no'] ?? null,
            'name_appears_on_bill' => $meter['name_appears_on_bill'] ?? ($meter['bill_name'] ?? ($meter['name_on_bill'] ?? null)),
            'current_meter_read' => $meter['current_meter_read'] ?? null,
            'meter_serial_no' => $meter['meter_serial_no'] ?? null,
            'last_bill_amount' => $meter['last_bill_amount'] ?? null,
            'mode' => $meter['mode'] ?? null,
        ];
    }

    private function getNextApplicationNumber(): string
    {
        $lastApplication = Application::latest('id')->first();

        if (!$lastApplication || empty($lastApplication->application_num)) {
            return '001';
        }

        $number = preg_replace('/[^0-9]/', '', (string) $lastApplication->application_num);
        return '' . str_pad(((int) $number) + 1, 3, '0', STR_PAD_LEFT);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => ['string', 'max:50']
        ]);

        $application = Application::findOrFail($id);
        // Store the old status for comparison
        $oldStatus = $application->status;

        $application->status = $request->input('status');
        $application->save();

         // Log the status change activity
         activity()
        ->causedBy(Auth::user())  // The user performing the action
        ->performedOn($application)  // The application being updated
        ->withProperties([
            'old_status' => $oldStatus,
            'new_status' => $application->status,
        ])  // Log the old and new status
        ->log("Updated status for application: {$application->application_num} from '{$oldStatus}' to '{$application->status}'");


        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully'
        ]);
    }


    public function print($id)
    {
        $application = Application::with(['directors', 'meters'])->findOrFail($id);

        // Load the PDF view with the application data
        $pdf = Pdf::loadView('backend.applications.print', compact('application'))
            ->setPaper('a4', 'portrait');

        // Stream the PDF and set headers to force open in a new tab
        return response($pdf->output())
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="application-' . $application->application_num . '.pdf"')
            ->header('Cache-Control', 'private, max-age=0, must-revalidate') // Add cache control
            ->header('Pragma', 'public') // Add pragma
            ->header('Expires', '0'); // Disable caching
    }


public function updateCommission(Request $request, $id)
{
    $request->validate([
        'commission_amount' => ['required', 'numeric', 'min:0'],
        'mature_date' => ['nullable', 'date'],
        'paid_date' => ['nullable', 'date'],
    ]);

    $application = Application::findOrFail($id);

    // Check if commission already existed
    $oldCommission = $application->commission_amount;
    $oldMatureDate = $application->mature_date;
    $oldPaidDate = $application->paid_date;

    // Update values
    $application->commission_amount = $request->commission_amount;
    $application->mature_date = $request->mature_date;
    $application->paid_date = $request->paid_date;

    // Agar commission pehle finalize/transferred tha
    // aur admin ne kuch change kiya hai to status reset ho jaye
    $hasChanged =
        $oldCommission != $request->commission_amount ||
        $oldMatureDate != $request->mature_date ||
        $oldPaidDate != $request->paid_date;

    if ($hasChanged) {
        $application->payout_status = 'pending';
        $application->payout_finalized_at = null;
        $application->payout_finalized_by = null;
    }

    $application->save();

    return back()->with('success', 'Commission updated successfully.');
}




public function finalizePayout($id)
{
    $application = Application::where('user_id', auth()->id())
        ->whereNotNull('commission_amount')
        ->findOrFail($id);

    if ($application->payout_status === 'transferred') {
        return back()->with('error', 'This payout is already transferred.');
    }

    $application->payout_status = 'transferred';
    $application->paid_date = now()->toDateString();
    $application->payout_finalized_at = now();
    $application->payout_finalized_by = auth()->id();
    $application->save();

    return back()->with('success', 'Payout finalized successfully.');
}


}
