<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = ['name', 'image', 'testimonial_detail', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
