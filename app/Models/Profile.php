<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'code',
        'designation',
        'status',
        'cnic_no',
        'mobile_no',
        'email',
        'marital_status',
        'dob',
        'religion',
        'floor',
        'shift',
        'department',
        'account_title',
        'account_number',
        'address'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
