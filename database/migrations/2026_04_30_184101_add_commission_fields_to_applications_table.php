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
    Schema::table('applications', function (Blueprint $table) {
        $table->decimal('commission_amount', 12, 2)->nullable()->after('status');
        $table->date('mature_date')->nullable()->after('commission_amount');
        $table->date('paid_date')->nullable()->after('mature_date');

        $table->enum('payout_status', ['pending', 'finalized', 'transferred'])
            ->default('pending')
            ->after('paid_date');

        $table->timestamp('payout_finalized_at')->nullable()->after('payout_status');
        $table->foreignId('payout_finalized_by')->nullable()->constrained('users')->nullOnDelete();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            //
        });
    }
};
