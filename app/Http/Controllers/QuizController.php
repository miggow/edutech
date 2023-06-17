<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Answer;
use App\Quiz;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.quiz.index');
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
        // Lưu thông tin bài quiz
        $quiz = Quiz::create([
            'name' => $request->input('name'),
            'module_id' => $request->input('module_id'),
        ]);

        // Lưu các câu hỏi và đáp án
        if ($request->has('questions')) {
            foreach ($request->input('questions') as $questionData) {
                // Lưu thông tin câu hỏi
                $question = Question::create([
                    'question' => $questionData['text'],
                    'quiz_id' => $quiz->id,
                ]);
                $isCorrectIndex = (int)$questionData['correct_answer']; // Chuyển đổi về kiểu số nguyên
                // Lưu thông tin đáp án
                if (isset($questionData['answers'])) {
                    foreach ($questionData['answers'] as  $index => $answerData) {
                        $answer = Answer::create([
                            'text' => $answerData['text'],
                            'question_id' => $question->id,
                            'is_correct' => ($index === $isCorrectIndex) ? 1 : 0,
                        ]);
                    }
                }
            }
        }

        return redirect()->back()->with('success', ['status' => 1, 'message' => 'Tạo bài quiz thành công!']);
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
}
