<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('application_meters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained('applications')->cascadeOnDelete();
            $table->string('meter_type')->nullable();
            $table->string('supplier_name')->nullable();
            $table->string('mpan_top')->nullable();
            $table->string('mpan_bottom')->nullable();
            $table->string('mprn_no')->nullable();
            $table->string('offer_rate')->nullable();
            $table->string('contract_duration')->nullable();
            $table->string('uplift')->nullable();
            $table->string('customer_no')->nullable();
            $table->string('name_appears_on_bill')->nullable();
            $table->string('current_meter_read')->nullable();
            $table->string('meter_serial_no')->nullable();
            $table->string('last_bill_amount')->nullable();
            $table->string('mode')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('application_meters');
    }
};
