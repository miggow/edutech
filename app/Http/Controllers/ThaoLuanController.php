<?php

namespace App\Http\Controllers;
use App\ThaoLuan;
use App\ClassRoom;
use Auth;
use Illuminate\Http\Request;

class ThaoLuanController extends Controller
{
    public function getThaoLuan(Request $request)
    {
        $posts = ThaoLuan::where('class_id', $request->class_id);
    }
    public function store(Request $request)
    {
        $post = new ThaoLuan();
        $post->user_id = Auth::user()->id;
        $post->class_id = $request->class_id;
        $post->content = $request->thaoluan;
        $post->save();
        return back();
    }
    public function delete($id)
    {
        $post = ThaoLuan::findOrFail($id);
        $post->delete();
        return back();
    }
}
