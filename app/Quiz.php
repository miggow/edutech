<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Question;
use App\Answer;
use App\Result;
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
    public function results()
    {
        return $this->hasMany(Result::class);
    }
    static function updateQuiz($quiz, $val){
        if ($quiz->questions) {
            foreach ($quiz->questions as $question) {
                $question->delete();
            }
        }   
        foreach ($val as $key => $value) {
            $question = Question::create([
                    'question' => $value['text'],
                    'quiz_id' => $quiz->id,
            ]);
            $isCorrectIndex = (int)$value['correct_answer']; // Chuyển đổi về kiểu số nguyên
            foreach ($value['answers'] as  $index => $answerData) {
                $answer = Answer::create([
                    'text' => $answerData['text'],
                    'question_id' => $question->id,
                    'is_correct' => ($index === $isCorrectIndex) ? 1 : 0,
                ]);
            }
        }
    }

}
