<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanFeature extends Model
{
    protected $fillable = ['subscribtion_plan_id', 'feature_name'];

      public function plan()
    {
        return $this->belongsTo(SubscribtionPlan::class, 'subscribtion_plan_id', 'id');
    }

}
