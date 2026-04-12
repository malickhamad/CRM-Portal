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
    //
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
    $nextNum = $this->getNextApplicationNumber(); // Number generate kiya
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

     public function notepad() {
        return view('backend.notepad.notepad');
    }

public function applications() {
    $applications = Application::latest()->get();

    // Agar sirf login user (Agent) ki applications dikhani hain:
    // $applications = Application::where('user_id', auth()->id())->latest()->get();

    return view('backend.applications.applications', compact('applications'));
}





    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $app = new Application();

            // Core & Customer Detail
            $app->application_agent = $request->application_agent;
            $app->application_num = $request->application_num ?? 'APP-' . time();
            $app->service_type = $request->service_type; // Isko blade mein hidden field se bhejein

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
            $app->utility_email = $request->utility_email;
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
            if ($request->hasFile('bill_upload')) { // Changed name to avoid conflict with `bill` function
                $app->bill_upload = $request->file('bill_upload')->store('kyc', 'public');
            }
            if ($request->hasFile('bank_statement')) {
                $app->bank_statement = $request->file('bank_statement')->store('kyc', 'public');
            }
            if ($request->hasFile('additional_uploads')) {
                $app->additional_uploads = $request->file('additional_uploads')->store('kyc', 'public');
            }

            $app->save(); // Main table saved

            // 2. SAVE DIRECTORS (Agar Blade form mein `name="director_name[]"` array hai)
            if ($request->has('director_name') && is_array($request->director_name)) {
                foreach ($request->director_name as $key => $name) {
                    if (!empty($name)) {


                    ApplicationDirector::create([
                            'application_id' => $app->id,
                            'director_name'  => $name,
                            'date_of_birth'  => $request->director_dob_array[$key] ?? null, // use array name for dynamic
                            'phone_no'       => $request->director_phone[$key] ?? null,
                            'email_address'  => $request->director_email[$key] ?? null,
                            'home_address'   => $request->director_home_address[$key] ?? null,
                        ]);
                    }
                }
            }

            // 3. SAVE METERS (Agar Blade form mein `name="supplier_name[]"` array hai)
            if ($request->has('supplier_name') && is_array($request->supplier_name)) {
                foreach ($request->supplier_name as $key => $supplier) {
                    if (!empty($supplier)) {
                        ApplicationMeter::create([
                            'application_id'       => $app->id,
                            'meter_type'           => $request->meter_type[$key] ?? null, // Specify Gas or Elec in blade
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
        $app = Application::findOrFail($id);

        // Puraana data delete karo dynamic forms wala
        $app->directors()->delete();
        $app->meters()->delete();

        // --- NOTE: Update k liye same store wala logic repeat hoga ---
        // Pura update karne k liye aap yahan $app->update($request->except(['director_name', ...]));
        // kar ke baqi dobara save karwa sakte hain.

        return back()->with('success', 'Application Updated Successfully!');
    }

    public function destroy($id)
    {
        $app = Application::findOrFail($id);
        $app->delete(); // Directors aur meters automatically cascade delete ho jayenge
        return back()->with('success', 'Application Deleted Successfully!');
    }


//  function agla unique number generate karega application k
private function getNextApplicationNumber() {
    $lastApplication = Application::latest('id')->first();

    if (!$lastApplication) {
        return "";
    } else {
        $number = preg_replace('/[^0-9]/', '', $lastApplication->application_num);
        return "" . str_pad((int)$number + 1, 3, '0', STR_PAD_LEFT);
    }

      
}

}
