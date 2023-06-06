@extends('frontend.app')
@section('content')
    <div class="bg-navbar-theme ">

        <img src="{{ asset('assets/assets/img/backgrounds/papers.co-bf55-school-anime-illust-orange-minimal-simple-art-26-wallpaper.jpg') }}"
            height="35%" width="100%" style="object-fit: cover" alt="...">
        <hr>
        {{-- course list --}}
        <section class="p-5">
            <div class="row mx-0 justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title text-center position-relative mb-5">
                        <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">KHÓA HỌC</h6>
                        <h1 class="display-4 text-dark">CÁC KHÓA HỌC CỦA CHÚNG TÔI</h1>
                    </div>
                </div>
            </div>
            <div class="text-end mb-2">
                <a href="{{ route('FE.course') }}" class="btn btn-primary">Xem thêm</a>
            </div>
            <div class="row mb-5">
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

                                <a href="{{ route('FE.course_detail', $course->id) }}" class="btn btn-outline-primary">Chi
                                    tiết</a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </section>
    </div>
@endsection
