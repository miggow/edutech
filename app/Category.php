<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'user_id'];
    protected $table = 'categories';
    
    
    public function user() {
        return $this->belongsTo('App\User','user_id');
    }
    public function course()
    {
        return $this->hasMany(Course::class);
    }
}
