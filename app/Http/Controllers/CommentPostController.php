<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CommentPost;
use Auth;
class CommentPostController extends Controller
{
    function store(Request $request)
    {
        $comment = new CommentPost();
        $comment->user_id = Auth::user()->id;
        $comment->content = $request->binhluan;
        $comment->post_id = $request->post_id;
        $comment->save();
        session(['current_tab' => 'tab-id']);
        return redirect()->back();
    }
    public function delete($id)
    {
        $post = CommentPost::findOrFail($id);
        $post->delete();
        return back();
    }
}
