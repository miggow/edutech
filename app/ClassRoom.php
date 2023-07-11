<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    protected $fillable = ['code', 'name', 'user_id', 'description'];
    
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function posts()
    {
        return $this->hasMany(ThaoLuan::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function documents()
    {
        return $this->hasMany(Document::class, 'classroom_id');
    }
    public function course(){
        return $this->belongsTo(Course::class, 'course_id');
    }   
}
