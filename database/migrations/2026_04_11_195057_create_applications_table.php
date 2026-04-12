<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();

            // --- Application & Agent Info ---
            $table->string('application_agent')->nullable();
            $table->string('application_num')->unique();
            $table->string('service_type'); // Loan, Gas, Water, etc.

            // --- Customer Details ---
            $table->string('company_name')->nullable();
            $table->string('trading_name')->nullable();
            $table->string('business_entity')->nullable();
            $table->string('business_nature')->nullable();
            $table->string('title')->nullable();
            $table->string('merchant_full_name')->nullable();
            $table->string('first_name')->nullable(); // For Open Banking
            $table->string('last_name')->nullable();  // For Open Banking
            $table->string('position')->nullable();
            $table->string('email_address')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('landline_no')->nullable(); // Telecom/Broadband/Water
            $table->string('contact_person_name')->nullable(); // Telecom/Broadband/Water
            $table->string('companies_house_number')->nullable();
            $table->string('company_reg_no')->nullable();
            $table->string('vat_tax_number')->nullable();
            $table->string('trading_address')->nullable();
            $table->string('business_address')->nullable(); // Telecom/Broadband/Water
            $table->string('unit')->nullable(); // Telecom/Broadband/Water
            $table->string('home_address')->nullable(); // Telecom/Broadband/Water
            $table->string('postal_code')->nullable();
            $table->date('director_dob_single')->nullable(); // General DOB field

            // --- Application Specific Details ---
            $table->date('application_date')->nullable();
            $table->date('renewal_date')->nullable();
            $table->string('brand')->nullable();
            $table->string('card_machine_details')->nullable();
            $table->string('existing_funding')->nullable();
            $table->string('annual_consumption')->nullable(); // Gas/Elec
            $table->string('utility_email')->nullable(); // Electric/Gas Email
            $table->string('commercial_resident')->nullable(); // Gas/Elec
            $table->string('spid')->nullable(); // Water
            $table->string('qty')->nullable(); // Card Machine
            $table->string('delivery_address')->nullable(); // Card Machine
            $table->boolean('epos_system')->default(0); // Card Machine
            $table->text('comment')->nullable();

            // --- Monthly Rental (Card Machine Specific) ---
            $table->string('debit_card')->nullable();
            $table->string('credit_card')->nullable();
            $table->string('commercial_card')->nullable();
            $table->string('authentication_fee')->nullable();
            $table->string('pci')->nullable();
            $table->string('rental')->nullable();

            // --- Bank Details ---
            $table->string('name_on_account')->nullable();
            $table->string('account_number')->nullable();
            $table->string('sort_code')->nullable();
            $table->string('iban')->nullable();
            $table->string('bic')->nullable();
            $table->string('name_of_bank')->nullable();

            // --- Other Details (Telecom, Water, Broadband) ---
            $table->string('bill_payment_method')->nullable();
            $table->string('landlord_name')->nullable();
            $table->string('name_of_new_customer')->nullable();
            $table->date('status_taken_date')->nullable();
            $table->string('password')->nullable();
            $table->string('customer_history')->nullable();

            // --- KYC Verification (File Paths) ---
            $table->string('picture_id')->nullable();
            $table->string('inside_outside_pics')->nullable();
            $table->string('bill_upload')->nullable();
            $table->string('bank_statement')->nullable();
            $table->string('additional_uploads')->nullable();

            $table->timestamps();
        });
    }

    public function down() { Schema::dropIfExists('applications'); }
};
