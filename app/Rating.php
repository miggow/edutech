<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'user_id', 'course_id', 'rating', 'message'
    ];
    protected $filltable = 'ratings';
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
