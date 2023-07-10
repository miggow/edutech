<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable=['user_id','quiz_id','points','results'];
    protected $casts=['results'=>'array'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
