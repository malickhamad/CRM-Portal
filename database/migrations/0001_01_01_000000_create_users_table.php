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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('business_name')->nullable();         // business name
            $table->string('phone')->nullable();                  // phone number
            $table->string('country')->nullable();                // country
            $table->string('state')->nullable();                  // state
            $table->string('city')->nullable();                   // city
            $table->string('street_address')->nullable();         // street address
            $table->string('profile_picture')->nullable();
            $table->boolean('profile_completed')->default(false); // NEW: profile completion flag

            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('created_by')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            $table->softDeletes();

            // Foreign key for parent_id (if any)
            $table->foreign('parent_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['parent_id']); // Drop foreign key first
            $table->dropColumn('parent_id');   // Then drop the column
        });

        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
    }
};
