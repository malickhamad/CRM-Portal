<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('profiles', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('name')->nullable();
        $table->string('code')->nullable();
        $table->string('designation')->nullable();
        $table->string('status')->nullable();
        $table->string('cnic_no')->nullable();
        $table->string('mobile_no')->nullable();
        $table->string('email')->nullable();
        $table->string('marital_status')->nullable();
        $table->date('dob')->nullable();
        $table->string('religion')->nullable();
        $table->string('floor')->nullable();
        $table->string('shift')->nullable();
        $table->string('department')->nullable();
        $table->string('account_title')->nullable();
        $table->string('account_number')->nullable();
        $table->text('address')->nullable();
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
