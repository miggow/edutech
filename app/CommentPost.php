<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentPost extends Model
{
    protected $fillable = [
        'user_id', 'post_id','content',
    ];
    public function thaoLuan()
    {
        return $this->belongsTo(ThaoLuan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
