@extends('panel.app')
@section('css')
@endsection
@section('content')
    <div class="card p-4">
        <h4 class="fw-bold py-3 mb-4">Danh sách bài tập đã hoàn thành</h4>
        <div class="table-responsive">
            <table class="table font-14 ">
                <tr>
                    <th class="text-left">Tiêu đề khóa học</th>
                    <th class="text-left">Tên bài tập</th>
                    <th>Điểm</th>
                    <th>Ngày hoàn thành</th>
                </tr>
                <tr>
                    @foreach ($results as $result)
                        @php
                            $result_id = $result->id;
                            $ids = \App\Result::where('id', $result_id)
                                ->with('quiz.module.course')
                                ->first();
                            if ($ids) {
                                $course_id = $ids->quiz->module->course->id;
                                $module_id = $ids->quiz->module->id;
                                $quiz_id = $ids->quiz->id;
                            }
                            $course = \App\Course::where('id', $course_id)->first();
                            $quiz = \App\Quiz::where('id', $quiz_id)->first();
                        @endphp
                        
                            <td>{{ $course->title }}</td>
                            <td><a href="{{ route('learn.results', $quiz->id) }}">{{ $quiz->name }}</a></td>
                            <td>{{ $result->points }}</td>
                            <td>{{ \Carbon\Carbon::parse($course->created_at)->format('d/m/Y') }}</td>
                        
                    @endforeach
                </tr>
            </table>
        </div>
    </div>
@endsection

@section('js')
@endsection
