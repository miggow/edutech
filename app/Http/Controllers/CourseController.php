<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Auth;
use App\Course;
use App\User;
use App\ClassRoom;
use Illuminate\Support\Str;
class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all(); 
        $categories = Category::all();
        $instructors = User::where('role', '1')->get();
        return view('panel.course.index', compact('courses','categories', 'instructors'));
    }
    public function store(Request $request)
    {
        $course = new Course();
        $course->fill($request->only(['title','category_id','description','price','instructor_id']));
        if ($request->hasFile('image')) {
            $file = $request->image->store('images', 'public');
            $course->image= 'storage/'.$file;
        }
        if ($request->hasFile('background')) {
            $file = $request->background->store('images', 'public');
            $course->background= 'storage/'.$file;
        }
        if ($request->hasFile('video')) {
            $file = $request->video->store('videos', 'public');
            $course->video= 'storage/'.$file;
        }
        $course->user_id = Auth::user()->id;
        $course->save();
        
        $class = new ClassRoom();
        $class->name = $request->title;
        $class->code =  Str::random(10);
        $class->user_id = Auth::user()->id;
        $class->description = $request->description;
        $class->course_id = $course->id;
        $class->save();
        // dd($class->id);
        \session()->flash('success', 'Tạo khóa học thành công.');
        $user = User::find($request->instructor_id);
        $user->classRooms()->attach($class->id);

        return redirect()->back();
    }
    public function edit($id)
    {
        $course = Course::find($id);
         $categories = Category::all();
        $instructors = User::where('role', '1')->get();
        return view('panel.course.edit', compact('course','categories','instructors'));
    }
    public function update(Request $request, $id) 
    {
        $course = Course::find($id);
         if ($request->hasFile('image')) {
            $file = $request->image->store('images', 'public');
            $course->image= 'storage/'.$file;
        }
        if ($request->hasFile('background')) {
            $file = $request->background->store('images', 'public');
            $course->background= 'storage/'.$file;
        }
        if ($request->hasFile('video')) {
            $file = $request->video->store('videos', 'public');
            $course->video= 'storage/'.$file;
        }
        $course->fill($request->only(['instructor_id',' category_id', 'title','price','description']));
        $course->save();
        \session()->flash('success', 'Cập nhật thành công!');

        return redirect()->route('course.index');
    }
    public function destroy($id)
    {
        $course = Course::find($id);
        $course->delete();
        \session()->flash('success', 'Xóa khóa học thành công.');

        return redirect()->back();
    }
}
