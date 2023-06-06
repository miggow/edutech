@extends('learn.layout')
@section('content')
    <div class="row">
        <div class="col-xl-9">
            <div class="progress">
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
        <div class="col-xl-3">
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
                            @endphp
                            @foreach ($lessons as $lesson)
                                <div class="accordion-body">
                                    <a href="#" onclick="changeVideoSource('{{ asset($lesson->video) }}')">
                                        {{ $lesson->name }}</a>
                                    {!! $lesson->description !!}
                                </div>
                            @endforeach

                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection
@section('js')
    <script>
        function changeVideoSource(videoSrc) {
            const video = document.getElementById('lesson-video');
            const source = video.querySelector('source');
            source.src = videoSrc;
            video.load();
        }
    </script>
    <script>
        var video = document.getElementById('lesson-video');
        var supposedCurrentTime = 0; //lưu thời điểm hiện tại của video mà người dùng đang xem.

        var video = document.getElementById('lesson-video');
        var supposedCurrentTime = 0;
        var progressBar = document.getElementById('progress-bar');
        video.addEventListener('timeupdate',
            function() { // Sự kiện này được kích hoạt mỗi khi thời gian hiện tại của video thay đổi.

                //nếu video không đang trong quá trình tua (!video.seeking), tức là người dùng không đang thực hiện hành động tua video. 
                //Khi không có hành động tua, chúng ta cập nhật giá trị của supposedCurrentTime thành thời gian hiện tại của video (video.currentTime).
                if (!video.seeking) {
                    supposedCurrentTime = video.currentTime;
                }
            });
        // Ngăn người dùng tua video
        video.addEventListener('seeking',
            function() { //Sự kiện này được kích hoạt khi người dùng thực hiện hành động tua video.
                var delta = video.currentTime - supposedCurrentTime;
                if (Math.abs(delta) >
                    0.01
                ) { //Nếu sự khác biệt lớn hơn 0.01 (giá trị tùy chỉnh), tức là người dùng đã thực hiện hành động tua video, 
                    //chúng ta ghi thông báo "Seeking is disabled" vào console và đặt thời gian của video về giá trị supposedCurrentTime để ngăn chặn việc tua video.
                    console.log("Seeking is disabled");
                    video.currentTime = supposedCurrentTime;
                }
            });
        // Xóa bỏ đoạn mã sau nếu không cần tua lại
        video.addEventListener('ended', function() { //Sự kiện này được kích hoạt khi video đã phát hết và kết thúc.
            // thiết lập lại giá trị supposedCurrentTime về 0. cho phép tua lại video từ đầu nếu muốn.
            supposedCurrentTime = 0;
        });

        video.addEventListener('timeupdate', function() {
            if (!video.seeking) {
                supposedCurrentTime = video.currentTime;
                var percent = (supposedCurrentTime / video.duration) * 100;
                progressBar.style.width = percent + '%';
                progressBar.innerHTML = Math.round(percent) + '%';
                progressBar.setAttribute('aria-valuenow', Math.round(percent));
            }
        });
    </script>
@endsection
