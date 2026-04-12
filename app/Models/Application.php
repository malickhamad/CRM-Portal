<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $guarded = []; // Saari fields allow hongi

    public function directors() {
        return $this->hasMany(ApplicationDirector::class);
    }

    public function meters() {
        return $this->hasMany(ApplicationMeter::class);
    }
}
