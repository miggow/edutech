<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = ['classroom_id', 'title','description', 'file_path'];

    public function class()
    {
        return $this->belongsTo(ClassRoom::class);
    }
}
