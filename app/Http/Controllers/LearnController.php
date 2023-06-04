<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Module;
use App\Course;
use App\Lesson;
use App\Auth;
use App\Category;

class LearnController extends Controller
{
    public function index($id)
    {
        $course =Course::find($id);
        return view('learn.course.index', compact('course'));
    }
}
