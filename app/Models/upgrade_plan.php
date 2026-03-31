<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class upgrade_plan extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'current_plan_id',
        'requested_plan_id',
        'reason',
        'status',
        'admin_notes',
        'processed_by',
        'processed_at'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function currentPlan(): BelongsTo
    {
        return $this->belongsTo(SubscribtionPlan::class, 'current_plan_id');
    }

    public function requestedPlan(): BelongsTo
    {
        return $this->belongsTo(SubscribtionPlan::class, 'requested_plan_id');
    }

    public function processedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'processed_by');
    }
}
