<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'answers';
    protected $fillable = ['text', 'question_id', 'is_correct'];
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
