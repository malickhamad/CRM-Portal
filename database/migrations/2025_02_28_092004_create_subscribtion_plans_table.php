<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subscribtion_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');  // Plan name (Standard, Premium)
            $table->decimal('price', 8, 2); // Price of plan
            $table->string('billing_cycle'); // monthly, yearly
            $table->string('description')->nullable();
            $table->string('icon')->nullable();
            $table->boolean('is_popular')->default(false)->nullable(); // Mark as popular
            $table->boolean('is_free')->default(false);
            $table->integer('no_of_standards')->default(1);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscribtion_plans');
    }
};
