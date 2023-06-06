<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
