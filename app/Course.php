<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'background',
        'video',
        'status',
        'price',
        'user_id',
        'instructor_id',
        'category_id'
        
    ];
    protected $filltable = 'courses';

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function modules()
    {
        return $this->hasMany(Module::class,'course_id');
    }
}
