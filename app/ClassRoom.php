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
}
