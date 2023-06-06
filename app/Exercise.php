<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
     public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
