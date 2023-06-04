<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Module;
use App\Lesson;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $module = Module::find($id);
        $lessons = Lesson::where('module_id', $module->id)->get();
        return view('panel.lesson.index', compact('module', 'lessons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lesson = new Lesson();
        $lesson->fill($request->only(['description','name', 'module_id']));
        if ($request->hasFile('video')) {
            $file = $request->video->store('videos', 'public');
            $lesson->video= 'storage/'.$file;
        }
        $lesson->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lesson = Lesson::find($id);
        return view('panel.lesson.edit', compact('lesson'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $lesson =  Lesson::find($id);
        $lesson->fill($request->only(['description','name', 'module_id']));
        if ($request->hasFile('video')) {
            $file = $request->video->store('videos', 'public');
            $lesson->video = 'storage/'.$file;
        }
        $lesson->save();
        // $lesson->update(['description' => $request->description, 'name'=>$request->name, 'module_id' =>$mid]);
        return redirect()->route('lesson.index',$request->module_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $lesson = Lesson::find($id);
        $lesson->delete();
        return redirect()->back();
    }
}
