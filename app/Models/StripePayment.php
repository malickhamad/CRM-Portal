<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\SubscribtionPlan;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class StripePayment extends Model
{
    use SoftDeletes;

    protected $table = 'stripe_payments';

    protected $fillable = [
        'user_id',
        'subscribtion_plan_id',
        'session_id',
        'amount',
        'currency',
        'stripe_subscription_id',
        'stripe_customer_id',
        'starts_at',
        'ends_at',
        'is_active',
        'payment_method',
        'transaction_reference',
        'cheque_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function subscriptionPlan()
    {
        return $this->belongsTo(SubscribtionPlan::class, 'subscribtion_plan_id');
    }


    public function paymentStandards()
    {
        return $this->hasMany(PaymentStandard::class);
    }
    public function standards()
    {
        return $this->belongsToMany(Standard::class, 'payment_standards')
                    ->withPivot('user_id')
                    ->withTimestamps();
    }
}
