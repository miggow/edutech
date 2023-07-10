@extends('frontend.app')
@section('content')
    <style>
        .rating-stars input[type="radio"] {
            position: absolute;
            left: -9999px;
        }

        .rating-stars label.star {
            display: inline-block;
            margin: 0;
            padding: 0;
            cursor: pointer;
        }

        .rating-stars label.star:before {
            content: '\2605';
            /* Ngôi sao UTF-8 */
            font-size: 25px;
            color: #ddd;
        }

        .rating-stars input[type="radio"]:checked+label.star:before,
        .rating-stars input[type="radio"]:hover+label.star:before {
            color: #ffcc00;
            /* Màu sắc khi được chọn hoặc hover */
        }
    </style>
    @php
        if (Auth::check()) {
            $hasOrdered = auth()
                ->user()
                ->orders()
                ->where('course_id', $course->id)
                ->exists();
        } else {
            $hasOrdered = false;
        }
        
    @endphp
    <div class="container py-5 ">
        <div class="row">
            <div class="col-lg-8">
                <div class="mb-5">
                    <div class="section-title position-relative mb-5">
                        <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2 text-dark ">Chi tiết
                            khóa học
                        </h6>
                        <h1 class="text-primary">{{ $course->title }}</h1>
                    </div>
                    <img class="img-fluid rounded w-100 mb-4" src="{{ asset($course->image) }}" alt="Image">
                    <p>{!! $course->description !!}</p>
                </div>
            </div>

            <div class="col-lg-4 mt-5 mt-lg-0">
                <div class="bg-info text-primary mb-5 py-3">
                    <h3 class="text-white py-3 px-4 m-0">Thông tin khóa học</h3>
                    <div class="d-flex justify-content-between border-bottom px-4">
                        <h6 class="text-white my-3">Giảng viên</h6>
                        <h6 class="text-white my-3">{{ $course->instructor->name }}</h6>
                    </div>
                    <div class="d-flex justify-content-between border-bottom px-4">
                        <h6 class="text-white my-3">Đánh giá</h6>
                        @php
                            $averageRating = App\Rating::where('course_id', $course->id)->avg('rating');
                            $roundedRating = round($averageRating, 1);
                        @endphp
                        <h6 class="text-white  my-3">{{ $roundedRating }} <small>({{ count($course->ratings) }})</small>
                        </h6>
                    </div>
                    <div class="d-flex justify-content-between border-bottom px-4">
                        <h6 class="text-white my-3">Bài giảng</h6>
                        <h6 class="text-white my-3">{{ count($course->lessons) }}</h6>
                    </div>
                    {{-- <div class="d-flex justify-content-between border-bottom px-4">
                        <h6 class="text-white my-3">Skill level</h6>
                        <h6 class="text-white my-3">All Level</h6>
                    </div>
                    <div class="d-flex justify-content-between px-4">
                        <h6 class="text-white my-3">Language</h6>
                        <h6 class="text-white my-3">English</h6>
                    </div> --}}

                    {{-- <div class="d-flex justify-content-between border-bottom px-4">
                        <h6 class="text-white my-3">Bài giảng</h6>
                        <h6 class="text-white my-3">{{ count($course->lessons) }}</h6>
                    </div> --}}
                    <div class="d-flex justify-content-between border-bottom px-4">
                        <h6 class="text-white my-3">Giá:</h6>
                        <h6 class="text-white my-3">{{ number_format($course->price, 0, '', '.') }} VND</h6>
                    </div>

                    @if (empty($hasOrdered))
                        <form action="{{ route('order.store', $course->id) }}" method="POST">
                            @csrf
                            <div class="d-flex flex-column px-4 mb-3">
                                <h6 class="text-white my-3">Phương thức thanh toán</h6>
                                <div class="payment text-gray  d-flex flex-column ">
                                    <div class="form-check"><input class="form-check-input" required type="radio" name="payment_method" id="method-0"
                                            value="0" required>
                                        <label for="method-0" class="star">VNPAY</label>
                                    </div>
                                    <div class="form-check"><input required class="form-check-input" type="radio" name="payment_method" id="method-1"
                                            value="1" required>
                                        <label for="method-1" class="star">MOMO</label>
                                    </div>
                                    {{-- <div class=""><input required type="radio" name="payment_method" id="method-2"
                                            value="2" required>
                                        <label for="method-2" class="star">Ngân hàng</label>
                                    </div>
                                    <div class=""><input required type="radio" name="payment_method" id="method-3"
                                            value="3" required>
                                        <label for="method-3" class="star">Paypal</label>
                                    </div> --}}
                                </div>
                            </div>

                            <div class="py-3 px-4">
                                {{-- <a href="{{ route('order.store') }}" name="redirect" class="btn btn-primary">Mua ngay</a> --}}
                                <button class="btn btn-primary" type="submit" name="redirect">Mua ngay</button>
                            </div>
                        </form>
                    @else
                        <div class="py-3 px-4">
                            <a href="{{ route('learn.index', $course->id) }}" class="btn btn-primary">Học</a>
                        </div>
                    @endif


                </div>
                <div class="mb-5">
                    <h2 class="mb-3 text-dark">Các bài giảng</h2>
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
                                            {{ $lesson->name }}
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mb-5">
                    <h2 class="mb-3 text-dark">Danh mục</h2>
                    @foreach ($categories as $category)
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <a href="{{ route('FE.course', ['category_id' => $category->id]) }}"
                                    class="text-decoration-none h6 m-0">{{ $category->name }}</a>
                                @php
                                    $courseCount = App\Course::where('category_id', $category->id)->count();
                                @endphp
                                <span class="badge badge-primary badge-pill">{{ $courseCount }}</span>
                            </li>
                        </ul>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8">
                @php
                    $ratings = $course->ratings;
                    
                @endphp
                @foreach ($ratings as $rating)
                    <div class="col-xxl">
                        <div class="card mb-4">
                            <div class="card-header">
                                <div class="row d-flex align-items-center">
                                    <div class="col-lg-1">
                                        <img src="{{ asset($rating->user->image) }}" class="avatar avatar-md "
                                            alt="">
                                    </div>
                                    <div class="col-lg-8"><b>{{ $rating->user->name }}</b></div>
                                </div>
                            </div>
                            <div class="card-body">
                                {{ $rating->message }}

                            </div>
                        </div>
                    </div>
                @endforeach

                @if (!empty($hasOrdered))
                    <div class="col-xxl">
                        <div class="card mb-4">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h5 class="mb-0">Bình luận và đánh giá</h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('post_rating', $course->id) }}">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="rating">Đánh giá:</label>
                                        <div class="rating-stars">
                                            <input required type="radio" name="rating" id="rating-1" value="1"
                                                required>
                                            <label for="rating-1" class="star"></label>
                                            <input required type="radio" name="rating" id="rating-2" value="2"
                                                required>
                                            <label for="rating-2" class="star"></label>
                                            <input required type="radio" name="rating" id="rating-3" value="3"
                                                required>
                                            <label for="rating-3" class="star"></label>
                                            <input required type="radio" name="rating" id="rating-4" value="4"
                                                required>
                                            <label for="rating-4" class="star"></label>
                                            <input required type="radio" name="rating" id="rating-5" value="5"
                                                required>
                                            <label for="rating-5" class="star"></label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="comment">Bình luận:</label>
                                        <textarea class="form-control" name="message" id="comment" rows="4" required></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Gửi đánh giá</button>
                                </form>

                            </div>
                        </div>
                    </div>
                @else
                    @if (!Auth::check())
                        <div class=" mb-4">
                            <a class="btn btn-primary" href="{{ route('login') }}">Vui lòng đăng nhập để bình luận và
                                đánh
                                giá</a>
                        </div>
                    @endif
                @endif



            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        // Sử dụng jQuery
        $(document).ready(function() {
            $('.rating-stars input[type="radio"]').click(function() {
                $('.rating-stars label.star').removeClass('selected');

                $(this).next('label.star').addClass('selected');
            });
        });
    </script>
@endsection
