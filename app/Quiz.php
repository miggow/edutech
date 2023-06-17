<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = ['name', 'module_id'];
    

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
    public function questions()
    {
        return $this->hasMany(Question::class,'quiz_id');
    }
}
