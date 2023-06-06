<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'course_id', 'payment_method'];

    protected $filltable = 'orders';
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
