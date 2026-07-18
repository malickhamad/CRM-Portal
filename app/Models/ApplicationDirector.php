<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApplicationDirector extends Model
{
    use HasFactory;

    protected $table = 'application_directors';

    protected $fillable = [
        'application_id',
        'director_name',
        'date_of_birth',
        'phone_no',
        'email_address',
        'home_address',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class, 'application_id');
    }
}
