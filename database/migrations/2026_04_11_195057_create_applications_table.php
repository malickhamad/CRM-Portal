<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('application_agent')->nullable();
            $table->string('application_num')->nullable();
            $table->string('service_type')->nullable();
             $table->string('status')->default('Pending');

            $table->string('company_name')->nullable();
            $table->string('trading_name')->nullable();
            $table->string('business_entity')->nullable();
            $table->string('business_nature')->nullable();
            $table->string('title')->nullable();
            $table->string('merchant_full_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('position')->nullable();
            $table->string('email_address')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('landline_no')->nullable();
            $table->string('contact_person_name')->nullable();
            $table->string('companies_house_number')->nullable();
            $table->string('company_reg_no')->nullable();
            $table->string('vat_tax_number')->nullable();

            $table->text('trading_address')->nullable();
            $table->text('business_address')->nullable();
            $table->string('unit')->nullable();
            $table->text('home_address')->nullable();
            $table->string('postal_code')->nullable();
            $table->date('director_dob_single')->nullable();

            $table->date('application_date')->nullable();
            $table->date('renewal_date')->nullable();
            $table->string('brand')->nullable();
            $table->text('card_machine_details')->nullable();
            $table->text('existing_funding')->nullable();
            $table->string('annual_consumption')->nullable();
            $table->string('utility_email')->nullable();
            $table->string('commercial_resident')->nullable();
            $table->string('spid')->nullable();
            $table->integer('qty')->nullable();
            $table->text('delivery_address')->nullable();
            $table->boolean('epos_system')->default(false);
            $table->text('comment')->nullable();

            $table->string('debit_card')->nullable();
            $table->string('credit_card')->nullable();
            $table->string('commercial_card')->nullable();
            $table->string('authentication_fee')->nullable();
            $table->string('pci')->nullable();
            $table->string('rental')->nullable();

            $table->string('name_on_account')->nullable();
            $table->string('account_number')->nullable();
            $table->string('sort_code')->nullable();
            $table->string('iban')->nullable();
            $table->string('bic')->nullable();
            $table->string('name_of_bank')->nullable();

            $table->string('bill_payment_method')->nullable();
            $table->string('landlord_name')->nullable();
            $table->string('name_of_new_customer')->nullable();
            $table->date('status_taken_date')->nullable();
            $table->string('password')->nullable();
            $table->text('customer_history')->nullable();

            $table->string('picture_id')->nullable();
            $table->string('inside_outside_pics')->nullable();
            $table->string('bill_upload')->nullable();
            $table->string('bank_statement')->nullable();
            $table->string('additional_uploads')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
