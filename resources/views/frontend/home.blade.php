@extends('frontend.app')
@section('content')
    <div class="bg-navbar-theme h-100 ">
        <section class="m-4 p-3">
            <div class="tieudekhoahoc">
                <h6>Danh sách các danh mục</h6>
            </div>
            <div class="boxtheloai row">
                @foreach ($categories as $category)
                    <div class="itemtheloai m-3 col-xl-2">
                        <a href="{{ route('FE.course', ['category_id' => $category->id]) }}">{{ $category->name }}</a>
                    </div>
                @endforeach

            </div>
        </section>
        {{-- Khóa học nổi bật --}}
        <section class="m-4 p-3">
            <div class="tieudekhoahoc">
                <h6>Các khóa học nổi bật</h6>
            </div>
            <div class="boxkhoahocnb my-4 row">
                @foreach ($courses as $course)
                    <div class="itemkhoahocnb col-2" style="height: 250px;">
                        <a class="h-100" href="{{ route('FE.course_detail', $course->id) }}">
                            <div class="imgkhoahocnb"><img class="" src="{{ asset($course->image) }}"
                                    alt="Card image cap"></div>
                            <div class="tenkhnb">{{ $course->title }}</div>
                            <div class="nguoidang">Giảng viên: {{ $course->instructor->name }} </div>
                            <div class="danhgia">
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                            </div>
                            <div class="giakhoahoc">{{ number_format($course->price, 0, '', ',') }} đ
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
        @if (count($free) > 0)
            <section class="m-4 p-3">
                <div class="tieudekhoahoc">
                    <h6>Các khóa học miễn phí</h6>
                </div>
                <div class="boxkhoahocnb my-4 row">
                    @foreach ($free as $course)
                        <div class="itemkhoahocnb col-2" style="height: 250px;">
                            <a class="h-100" href="{{ route('FE.course_detail', $course->id) }}">
                                <div class="imgkhoahocnb"><img src="{{ asset($course->image) }}" alt="Card image cap"></div>
                                <div class="tenkhnb">{{ $course->title }}</div>
                                <div class="nguoidang">Giảng viên: {{ $course->instructor->name }} </div>
                                <div class="danhgia">
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                </div>
                                <div class="giakhoahoc">Miễn phí
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        {{-- Thể Loại --}}
        {{-- course list --}}
        {{-- <section class="p-5">
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
        </section> --}}
    </div>
@endsection
