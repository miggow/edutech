<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThaoLuan extends Model
{
    protected $fillable = ['user_id', 'class_id', 'content'];
    
    public function class()
    {
        return $this->belongsTo(ClassRoom::class, 'class_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function commentPosts()
    {
        return $this->hasMany(CommentPost::class, 'post_id');
    }
}
