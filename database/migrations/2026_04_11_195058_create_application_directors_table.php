<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('application_directors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained('applications')->onDelete('cascade');
            $table->string('director_name')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('email_address')->nullable();
            $table->string('home_address')->nullable();
            $table->timestamps();
        });
    }

    public function down() { Schema::dropIfExists('application_directors'); }
};
