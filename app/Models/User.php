<?php

namespace App\Models;

use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, SoftDeletes, LogsActivity;
    protected $fillable = [
        'name',
        'email',
        'password',
        'password_confirmation',
        'roles',
        'parent_id',
        'created_by',
        'status',
        'profile_picture',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Parent user (for subusers)
    public function parent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    // Subusers relationship
    public function subusers(): HasMany
    {
        return $this->hasMany(User::class, 'parent_id');
    }


    // Testimonials relationship
    public function testimonials(): HasMany
    {
        return $this->hasMany(Testimonial::class);
    }

    // General many-to-many standards (basic relation)


    // Payment standards filtered by active stripe payments

    // Activity log options
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->useLogName('user');
    }

public function profile()
{
    return $this->hasOne(Profile::class);
}

}
