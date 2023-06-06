@extends('frontend.app')

@section('content')
    <div class="container-fluid py-5">
        <div class="container py-5">
            <section>
                <div class="row mx-0 justify-content-center">
                    <div class="col-lg-8">
                        <div class="section-title text-center position-relative mb-5">
                            <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">KHÓA HỌC</h6>
                            <h1 class="display-4">CÁC KHÓA HỌC CỦA CHÚNG TÔI</h1>
                        </div>
                    </div>
                </div>
                <div class="row mb-5">
                    @if (count($courses) != 0)
                        @foreach ($courses as $course)
                            <div class="col-5 col-sm-3 mb-3">
                                <div class="card h-100">
                                    <a href="{{ route('FE.course_detail', $course->id) }}">
                                        <img class="card-img-top" src="{{ asset($course->image) }}" alt="Card image cap">
                                    </a>
                                    <div class="card-body">
                                        <a href="{{ route('FE.course_detail', $course->id) }}">
                                            <h5 class="card-title">{{ $course->title }}</h5>
                                        </a>
                                        <div class="max-height-200 overflow-auto" style="height: 200px;">
                                            <p class="card-text">
                                                {!! $course->description !!}
                                            </p>
                                        </div>

                                        <a href="{{ route('FE.course_detail', $course->id) }}"
                                            class="btn btn-outline-primary">Chi
                                            tiết</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class=" card p-5 text-center">
                            <h1>Hiện không có khóa học nào</h1>
                        </div>
                    @endif


                </div>
            </section>
        </div>
    </div>
@endsection
