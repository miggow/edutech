<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LessonsCompleted extends Model
{
    protected $table = 'lessons_completed';

    protected $fillable = [
        'user_id',
        'lesson_id',
        'status',
    ];
}
