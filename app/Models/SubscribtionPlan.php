<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubscribtionPlan extends Model
{
    protected $fillable = ['name', 'price', 'billing_cycle', 'stripe_price_id', 'features', 'is_popular', 'subscribtion_plan_id', 'icon', 'description','no_of_standards', ];



    public function features(): HasMany
    {
        return $this->hasMany(PlanFeature::class, 'subscribtion_plan_id', 'id');
    }

    public function standards()
    {
        return $this->belongsToMany(Standard::class, 'standard_subscription_plan', 'subscribtion_plan_id', 'standard_id');
    }





}
