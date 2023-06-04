<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $filltable = 'lessons';

    protected $fillable = ['name', 'description','video','module_id'];
    

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }
}
