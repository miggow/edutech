@extends('learn.layout')
@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <div class="row">
            <div class="col-xl-9 p-2">
                <div class="progress mb-3">
                    <div id="progress-bar" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                        aria-valuemax="100">
                        0%
                    </div>
                </div>
                <div class="col-12">
                    <div class="card mb-4">
                        <div class=" card-img">
                            <video width="100%" height="100%" controls id="lesson-video">
                                <source src="{{ asset($course->video) }}" type="video/mp4">
                            </video>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 p-2">
                {{-- Bài giảng --}}
                <h5 class="mt-3">Bài giảng</h5>
                <div class="accordion " id="accordionExample">
                    @php
                        $modules = $course->modules;
                    @endphp
                    @foreach ($modules as $module)
                        <div class="card accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#accordionTwo-{{ $module->id }}" aria-expanded="false"
                                    aria-controls="accordionTwo-{{ $module->id }}">
                                    {{ $module->name }}
                                </button>
                            </h2>
                            <div id="accordionTwo-{{ $module->id }}" class="accordion-collapse collapse"
                                aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                @php
                                    $lessons = $module->lessons;
                                    $quizzes = $module->quizzes;
                                @endphp
                                @foreach ($lessons as $index => $lesson)
                                    <div class="accordion-body lesson_id" data-lesson-id="{{ $lesson->id }}">
                                        @php
                                            $previousLesson = $lesson->getPreviousLesson();
                                            $previousLessonCompleted = $previousLesson ? $previousLesson->isCompleted() : true;
                                            $lessonCompleted = $lesson->isCompleted();
                                        @endphp
                                        @if ($previousLessonCompleted || $lessonCompleted)
                                            <a href="#"
                                                onclick="changeVideoSource('{{ asset($lesson->video) }}'); saveLessonId({{ $lesson->id }})">
                                                {{ $lesson->name }}</a>
                                        @else
                                            {{ $lesson->name }} (Chưa hoàn thành)
                                        @endif
                                        {!! $lesson->description !!}
                                    </div>
                                @endforeach

                                <small class="accordion-body">Danh sách các bài tập</small>
                                @foreach ($quizzes as $quiz)
                                    <div class="accordion-body">
                                        <a href="{{ route('learn.quiz', ['module_id' => $module, 'id' => $quiz->id]) }}"
                                            target="blank">
                                            {{ $quiz->name }}</a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>

        </div>
    </div>
@endsection
@section('js')
    <script>
        var video = document.getElementById('lesson-video');
        var progressBar = document.getElementById('progress-bar');
        var lessonCompleted = false; // Biến để kiểm tra xem bài học đã hoàn thành hay chưa

        video.addEventListener('timeupdate', function() {
            if (!video.seeking) {
                var percent = (video.currentTime / video.duration) * 100;
                progressBar.style.width = percent + '%';
                progressBar.innerHTML = Math.round(percent) + '%';
                progressBar.setAttribute('aria-valuenow', Math.round(percent));

                if (percent >= 90 && percent <= 100 && !lessonCompleted) {
                    lessonCompleted = true;
                    // Gọi hàm khi bài học đã được coi đến 90-100%
                    lessonFinished();
                }
            }
        });
        var lessonId;

        function saveLessonId(id) {
            lessonId = id;
        }

        function lessonFinished() {

            var status = 1;
            $.ajax({
                url: '/save-lesson-status', // Thay thế đường dẫn bằng route xử lý lưu trạng thái học
                method: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    lesson_id: lessonId,
                    status: status
                },
            });
        }

        function changeVideoSource(videoSrc) {
            video.src = videoSrc;
            video.load();
            lessonCompleted = false; // Đặt lại giá trị khi thay đổi video
        }
    </script>
@endsection
