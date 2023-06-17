<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Module;
use App\Course;
use App\Lesson;
use App\Auth;
use App\Category;
use App\Quiz;
use App\Answer;
class LearnController extends Controller
{
    public function index($id)
    {
        $course =Course::find($id);
        return view('learn.course.index', compact('course'));
    }
    public function getQuiz(Request $request)
    {   
        $quiz = Quiz::where('module_id', $request->module_id)->where('id', $request->id)->first();
        return view('learn.quiz.index', compact('quiz'));
    }
    public function doQuiz(Request $request, $id)
    {
        // dd($request->answers);
        $points=0;
        foreach ($request->answers as $key => $value) {
            $correct = Answer::where('question_id', $key)->where('id',$value)->first();
            if($correct->is_correct == 1)
            {
                $points++;
            }
        }
    }
}
