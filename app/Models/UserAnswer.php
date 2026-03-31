<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{

    protected $guarded = [];

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    // UserAnswer.php
public function answer()
{
    return $this->belongsTo(Answer::class, 'answer_id');
}


public function user()
{
    return $this->belongsTo(User::class);
}
}
