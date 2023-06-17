<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use Auth;
use App\ClassRoom;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\ThaoLuan;
use App\Document;
class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $classes_join = $user->classrooms;
        $classes = ClassRoom::where('user_id', Auth::user()->id)->get();
        return view('panel.class.index', compact('classes','classes_join'));
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
        $class = new ClassRoom();
        $class->fill($request->only(['name', 'description']));
        if($request->code)
        {
            $class->code = $request->code;
        }
        else{
            $class->code = Str::random(10);
        }
        $class->user_id = Auth::user()->id;
        $class->save();
        return redirect()->back()->with('success', ['status' => 1, 'message' => 'Tạo lớp học thành công!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $class = ClassRoom::find($id);
        $users = $class->users;
        $posts = ThaoLuan::where('class_id', $id)->get();
        return view('learn.class.list_class', compact('class','posts','users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function joinClass(Request $request)
    {
        $code = $request->input('code');

        $classRoom = ClassRoom::where('code', $code)->first();

        if ($classRoom) {
            $user = auth()->user();
            $user->classRooms()->attach($classRoom->id);

            return redirect()->back()->with('success', ['status' => 1, 'message' => 'Tham gia lớp học thành công!']);
        }

        return redirect()->back()->with('success', ['status' => 0, 'message' => 'Không đúng!']);

        
    }
    public function upload(Request $request, $classRoomId)
    {
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();

        $document = new Document();
        $document->title = $request->input('title');
        $document->description = $request->input('description');
        $document->file_path = $fileName;
        $document->classroom_id = $classRoomId;
        $document->save();

        // Lưu tệp đính kèm vào thư mục tùy chỉnh (ví dụ: public/documents)
        $file->storeAs('public/documents', $fileName);

        return redirect()->back()->with('success', 'Đăng tải thành công.');
    }
    
}
