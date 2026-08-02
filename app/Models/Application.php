<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Application extends Model
{
    use HasFactory;

    protected $table = 'applications';

    protected $fillable = [
        'user_id',
        'application_agent', 'sale_closer', 'application_num', 'service_type',
        'company_name', 'trading_name', 'business_entity', 'business_nature',
        'title', 'merchant_full_name', 'first_name', 'last_name', 'position',
        'email_address', 'phone_number', 'mobile_no', 'landline_no', 'contact_person_name',
        'companies_house_number', 'company_reg_no', 'vat_tax_number',
        'trading_address', 'business_address', 'unit', 'home_address', 'postal_code',
        'director_dob_single', 'application_date', 'renewal_date', 'brand',
        'card_machine_details', 'existing_funding', 'annual_consumption', 'utility_email',
        'commercial_resident', 'spid', 'qty', 'delivery_address', 'epos_system', 'comment',
        'debit_card', 'credit_card', 'commercial_card', 'authentication_fee', 'pci', 'rental',
        'name_on_account', 'account_number', 'sort_code', 'iban', 'bic', 'name_of_bank',
        'bill_payment_method', 'landlord_name', 'name_of_new_customer', 'status_taken_date',
        'password', 'customer_history',
        'picture_id', 'inside_outside_pics', 'bill_upload', 'bank_statement', 'additional_uploads','meter_pictures', 'status','commission_amount',
    'mature_date',
    'paid_date',
    'payout_status',
    'payout_finalized_at',
    'payout_finalized_by',
    ];

    protected $casts = [
        'application_date' => 'date',
        'renewal_date' => 'date',
        'director_dob_single' => 'date',
        'status_taken_date' => 'date',
        'epos_system' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function directors(): HasMany
    {
        return $this->hasMany(ApplicationDirector::class, 'application_id');
    }

    public function meters(): HasMany
    {
        return $this->hasMany(ApplicationMeter::class, 'application_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(ApplicationComment::class, 'application_id')->latest();
    }

    public function payoutFinalizedBy()
{
    return $this->belongsTo(User::class, 'payout_finalized_by');
}
}
