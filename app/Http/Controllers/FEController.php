<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Module;
use App\Category;
use App\Rating;
use Auth;
class FEController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('frontend.home', compact('courses'));
    }
    public function courseList(Request $request)
    {   
       $categoryId = $request->input('category_id');

        // Lấy danh sách khóa học
        $courses = Course::query();

        // Kiểm tra nếu có danh mục được chọn, thực hiện tìm kiếm theo danh mục
        if ($categoryId) {
            $courses->where('category_id', $categoryId);
        }

        $courses = $courses->get();

        return view('frontend.course.index', compact('courses'));
    }
    public function courseDetail($id)
    {
        $course = Course::find($id);
        $categories = Category::all();
        return view('frontend.course.detail', compact('course', 'categories'));
    }
    public function postRating(Request $request, $id)
    {
        $rating = new Rating();
        $rating->fill($request->only(['rating', 'message']));
        $rating->user_id = Auth::id();
        $rating->course_id = $id;
        $rating->save();
        return back();
    }
}
