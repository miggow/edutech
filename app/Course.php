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
    protected $table = 'courses';

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
    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }
     public function lessons()
    {
        return $this->hasManyThrough(Lesson::class, Module::class);
    }
    public function ratings()
    {
        return $this->hasMany(Rating::class, 'course_id');
    }
    public function orders()
    {
        return $this->hasMany(Order::class,'course_id');
    }
    public function classroom()
    {
        return $this->hasOne(ClassRoom::class,'course_id');
    }
}
