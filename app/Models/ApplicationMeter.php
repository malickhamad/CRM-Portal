<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApplicationMeter extends Model
{
    use HasFactory;

    protected $table = 'application_meters';

    protected $fillable = [
        'application_id',
        'meter_type',
        'supplier_name',
        'mpan_top',
        'mpan_bottom',
        'mprn_no',
        'offer_rate',
        'contract_duration',
        'uplift',
        'customer_no',
        'name_appears_on_bill',
        'current_meter_read',
        'meter_serial_no',
        'last_bill_amount',
        'mode',
    ];

    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class, 'application_id');
    }
}
