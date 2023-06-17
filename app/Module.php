<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = ['name', 'duration', 'course_id'];
    protected $filltable = 'modules';

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'module_id');
    }
    public function quizzes()
    {
        return $this->hasMany(Quiz::class, 'module_id');
    }
}
