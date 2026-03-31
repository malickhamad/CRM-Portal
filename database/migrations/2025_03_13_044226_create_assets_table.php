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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('asset_id');
            $table->string('type');
            $table->string('status');
            $table->string('ephi'); // Changed from boolean to string to match form options
            $table->string('encryption'); // Changed from boolean to string to match form options
            $table->string('assignment')->nullable();
            $table->string('location');
            $table->string('disposal_status')->nullable(); // Added disposal_status
            $table->date('disposed_date')->nullable(); // Added disposed_date
            $table->text('comments')->nullable(); // Added comments
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
