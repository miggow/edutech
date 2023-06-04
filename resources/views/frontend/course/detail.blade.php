@extends('frontend.app')
@section('content')
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-8">
                    <div class="mb-5">
                        <div class="section-title position-relative mb-5">
                            <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Chi tiết khóa học
                            </h6>
                            <h1 class="display-4">{{ $course->title }}</h1>
                        </div>
                        <img class="img-fluid rounded w-100 mb-4" src="{{ asset($course->image) }}" alt="Image">
                        <p>{!! $course->description !!}</p>


                    </div>

                    {{-- <h2 class="mb-3">Related Courses</h2>
                <div class="owl-carousel related-carousel position-relative" style="padding: 0 30px;">
                    <a class="courses-list-item position-relative d-block overflow-hidden mb-2" href="detail.html">
                        <img class="img-fluid" src="img/courses-1.jpg" alt="">
                        <div class="courses-text">
                            <h4 class="text-center text-white px-3">Web design & development courses for
                                beginners</h4>
                            <div class="border-top w-100 mt-3">
                                <div class="d-flex justify-content-between p-4">
                                    <span class="text-white"><i class="fa fa-user mr-2"></i>Jhon Doe</span>
                                    <span class="text-white"><i class="fa fa-star mr-2"></i>4.5
                                        <small>(250)</small></span>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a class="courses-list-item position-relative d-block overflow-hidden mb-2" href="detail.html">
                        <img class="img-fluid" src="img/courses-2.jpg" alt="">
                        <div class="courses-text">
                            <h4 class="text-center text-white px-3">Web design & development courses for
                                beginners</h4>
                            <div class="border-top w-100 mt-3">
                                <div class="d-flex justify-content-between p-4">
                                    <span class="text-white"><i class="fa fa-user mr-2"></i>Jhon Doe</span>
                                    <span class="text-white"><i class="fa fa-star mr-2"></i>4.5
                                        <small>(250)</small></span>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a class="courses-list-item position-relative d-block overflow-hidden mb-2" href="detail.html">
                        <img class="img-fluid" src="img/courses-3.jpg" alt="">
                        <div class="courses-text">
                            <h4 class="text-center text-white px-3">Web design & development courses for
                                beginners</h4>
                            <div class="border-top w-100 mt-3">
                                <div class="d-flex justify-content-between p-4">
                                    <span class="text-white"><i class="fa fa-user mr-2"></i>Jhon Doe</span>
                                    <span class="text-white"><i class="fa fa-star mr-2"></i>4.5
                                        <small>(250)</small></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div> --}}
                </div>

                <div class="col-lg-4 mt-5 mt-lg-0">
                    <div class="bg-primary mb-5 py-3">
                        <h3 class="text-white py-3 px-4 m-0">Thông tin khóa học</h3>
                        <div class="d-flex justify-content-between border-bottom px-4">
                            <h6 class="text-white my-3">Instructor</h6>
                            <h6 class="text-white my-3">John Doe</h6>
                        </div>
                        <div class="d-flex justify-content-between border-bottom px-4">
                            <h6 class="text-white my-3">Rating</h6>
                            <h6 class="text-white my-3">4.5 <small>(250)</small></h6>
                        </div>
                        <div class="d-flex justify-content-between border-bottom px-4">
                            <h6 class="text-white my-3">Lectures</h6>
                            <h6 class="text-white my-3">15</h6>
                        </div>
                        <div class="d-flex justify-content-between border-bottom px-4">
                            <h6 class="text-white my-3">Thời lượng</h6>
                            <h6 class="text-white my-3">{{ $course->duration }}</h6>
                        </div>
                        {{-- <div class="d-flex justify-content-between border-bottom px-4">
                        <h6 class="text-white my-3">Skill level</h6>
                        <h6 class="text-white my-3">All Level</h6>
                    </div>
                    <div class="d-flex justify-content-between px-4">
                        <h6 class="text-white my-3">Language</h6>
                        <h6 class="text-white my-3">English</h6>
                    </div> --}}
                        <h5 class="text-white py-3 px-4 m-0">Giá: {{ number_format($course->current_price, 0, '', '.') }}
                            VNĐ</h5>
                        <div class="py-3 px-4">
                            <a class="btn btn-block btn-secondary py-3 px-5" href="">Mua ngay</a>
                        </div>
                    </div>

                    <div class="mb-5">
                        <h2 class="mb-3">Categories</h2>
                        @php
                            $categories = App\Models\Category::all();
                        @endphp
                        @foreach ($categories as $category)
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <a href="" class="text-decoration-none h6 m-0">{{$category->name}}</a>
                                    @php
                                        $courseCount = App\Models\Course::where('category_id', $category->id)->count();
                                    @endphp
                                    <span class="badge badge-primary badge-pill">{{$courseCount}}</span>

                                </li>

                            </ul>
                        @endforeach

                    </div>

                    {{-- <div class="mb-5">
                    <h2 class="mb-4">Recent Courses</h2>
                    <a class="d-flex align-items-center text-decoration-none mb-4" href="">
                        <img class="img-fluid rounded" src="img/courses-80x80.jpg" alt="">
                        <div class="pl-3">
                            <h6>Web design & development courses for beginners</h6>
                            <div class="d-flex">
                                <small class="text-body mr-3"><i class="fa fa-user text-primary mr-2"></i>Jhon Doe</small>
                                <small class="text-body"><i class="fa fa-star text-primary mr-2"></i>4.5 (250)</small>
                            </div>
                        </div>
                    </a>
                    <a class="d-flex align-items-center text-decoration-none mb-4" href="">
                        <img class="img-fluid rounded" src="img/courses-80x80.jpg" alt="">
                        <div class="pl-3">
                            <h6>Web design & development courses for beginners</h6>
                            <div class="d-flex">
                                <small class="text-body mr-3"><i class="fa fa-user text-primary mr-2"></i>Jhon Doe</small>
                                <small class="text-body"><i class="fa fa-star text-primary mr-2"></i>4.5 (250)</small>
                            </div>
                        </div>
                    </a>
                    <a class="d-flex align-items-center text-decoration-none mb-4" href="">
                        <img class="img-fluid rounded" src="img/courses-80x80.jpg" alt="">
                        <div class="pl-3">
                            <h6>Web design & development courses for beginners</h6>
                            <div class="d-flex">
                                <small class="text-body mr-3"><i class="fa fa-user text-primary mr-2"></i>Jhon Doe</small>
                                <small class="text-body"><i class="fa fa-star text-primary mr-2"></i>4.5 (250)</small>
                            </div>
                        </div>
                    </a>
                    <a class="d-flex align-items-center text-decoration-none" href="">
                        <img class="img-fluid rounded" src="img/courses-80x80.jpg" alt="">
                        <div class="pl-3">
                            <h6>Web design & development courses for beginners</h6>
                            <div class="d-flex">
                                <small class="text-body mr-3"><i class="fa fa-user text-primary mr-2"></i>Jhon Doe</small>
                                <small class="text-body"><i class="fa fa-star text-primary mr-2"></i>4.5 (250)</small>
                            </div>
                        </div>
                    </a>
                </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
