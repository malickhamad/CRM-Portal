<?php

namespace App\Models;

use App\Models\StripePayment;
use App\Models\SubscribtionPlan;
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
        'business_name',         // Added business name
        'business_address',      // Added business address
        'phone',                 // Added phone
        'country',               // Added country
        'state',                 // Added state
        'city',                  // Added city
        'street_address',        // Added street address
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

    // Stripe payments relationship
    public function stripePayments(): HasMany
    {
        return $this->hasMany(StripePayment::class);
    }

    // Testimonials relationship
    public function testimonials(): HasMany
    {
        return $this->hasMany(Testimonial::class);
    }

    // General many-to-many standards (basic relation)
    public function standards(): BelongsToMany
    {
        return $this->belongsToMany(Standard::class);
    }

    // Payment standards filtered by active stripe payments
    public function paymentStandards(): BelongsToMany
    {
        return $this->belongsToMany(Standard::class, 'payment_standards')
            ->withPivot(['stripe_payment_id', 'created_at'])
            ->withTimestamps()
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('stripe_payments')
                    ->whereColumn('stripe_payments.id', 'payment_standards.stripe_payment_id')
                    ->where('stripe_payments.is_active', true);
            });
    }

    // Activity log options
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->useLogName('user');
    }

    // Custom activity log description
    public function getDescriptionForEvent(string $eventName): string
    {
        return "User {$this->name} has been {$eventName}";
    }


    // In User.php model
    public function sectionsWithReports()
    {
        return $this->hasManyThrough(
            Section::class,
            UserAnswer::class,
            'user_id', // Foreign key on UserAnswer table
            'id', // Foreign key on Section table
            'id', // Local key on User table
            'question_id' // Local key on UserAnswer table
        )->whereHas('questions.userAnswers')
            ->with('questions')
            ->distinct();
    }
// app/Models/User.php

public function userAnswers()
{
    return $this->hasMany(UserAnswer::class);
}

    // In your User model
    public function activeSubscription()
    {
        return $this->hasOne(StripePayment::class)->where('is_active', true)->latest();
    }


    public function canAccessSection($section)
    {
        // For main users
        if ($this->hasRole('User')) {
            return $this->paymentStandards()->whereHas('sections', function ($q) use ($section) {
                $q->where('id', $section->id);
            })->exists();
        }

        // For subusers
        if ($this->hasRole('Subuser')) {
            return $this->standards()->whereHas('sections', function ($q) use ($section) {
                $q->where('id', $section->id);
            })->exists();
        }

        return false;
    }
}
