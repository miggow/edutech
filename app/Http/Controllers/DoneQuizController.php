<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Result;
use App\Course;
use App\Lesson;
use App\Quiz;
use Auth;

class DoneQuizController extends Controller
{
    public function index()
    {
        $results = Result::where('user_id', Auth::user()->id)->get();
        
        
        return view('panel.my_course.index', compact('results'));
    }
}
