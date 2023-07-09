<?php

namespace App\Http\Controllers;
use App\Result;
use Illuminate\Http\Request;
use App\Module;
use App\Course;
use App\Lesson;
use Auth;
use App\Category;
use App\Quiz;
use App\Answer;
use Session;
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
        $result = Result::where('user_id', Auth::id())->where('quiz_id', $quiz->id)->first();
        if($result)
        {
            return redirect()->route('learn.results', $quiz->id);
        }
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
        $check = Result::where('user_id', Auth::user()->id)->where('quiz_id', $id)->first();
        if(!empty($check))
        {
            return redirect()->route('learn.results', $id);    
        }
        else{
            $results=new Result();
            $results->user_id= Auth::user()->id;
            $results->quiz_id= $id;
            $results->points=$points;
            $results->results=$request->answers;
            $results->save();
        }
        
        return redirect()->route('learn.results', $id);
    }
    
    public function results(Request $request, $id)
    {
        // dd(Session::get('results')->quiz_id);
        $quiz = Quiz::where('id',$id)->first();
        $results= Result::where('quiz_id', $id)->where('user_id',Auth::id())->first();
        return view('learn.quiz.results', compact('quiz','results'));
    }

}
