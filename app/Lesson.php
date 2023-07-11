<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\LessonsCompleted;
use Auth;
class Lesson extends Model
{
    protected $table = 'lessons';

    protected $fillable = ['name', 'description','video','module_id'];
    

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }
    public function getNextLesson()
    {
        return $this->module->lessons()
            ->where('id', '>', $this->id)
            ->orderBy('id', 'asc')
            ->first();
    }

   public function getPreviousLesson()
    {
        return $this->module->lessons()
            ->where('id', '<', $this->id)
            ->orderBy('id', 'desc')
            ->first();
    }

    public function isCompleted()
    {
        // Kiểm tra xem bài học đã hoàn thành hay chưa
        $checkCom = LessonsCompleted::where('user_id', Auth::id())
            ->where('lesson_id', $this->id)
            ->where('status', 1)
            ->first();

        if ($checkCom) {
            return true;
        } else {
            $previousLesson = $this->getPreviousLesson();

            if ($previousLesson && $previousLesson->isCompleted()) {
                return true;
            } else {
                return false;
            }
        }
    }


}
