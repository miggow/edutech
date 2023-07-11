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
                <div class="boxkhoahocnb my-3 row">
                    @foreach ($courses as $course)
                        <div class="itemkhoahocnb col-2" style="height: 250px;">
                            <a class="h-100" href="{{ route('FE.course_detail', $course->id) }}">
                                <div class="imgkhoahocnb"><img class="" src="{{ asset($course->image) }}"
                                        alt="Card image cap"></div>
                                <div class="tenkhnb">{{ $course->title }}</div>
                                <div class="nguoidang">Giảng viên: {{ $course->instructor->name }} </div>
                                <div class="danhgia">
                                 @php
                                    $ratings = \App\Rating::where('course_id', $course->id)->get();
                                    $sum = $ratings->sum('rating');
                                    $count = $ratings->count();
                                    if ($count == 0) {
                                        $avg = 0;
                                    } else {
                                        $avg = $sum / $count;
                                    }
                                    
                                @endphp
                                @if ($avg == 0)
                                    <br>
                                @else
                                    @php
                                        $numOfStars = (int) floor($avg); 
                                    @endphp
                                    @for ($i = 0; $i < $numOfStars; $i++)
                                        <i class='bx bxs-star'></i>
                                    @endfor
                                @endif
                            </div>
                                <div class="giakhoahoc">{{ number_format($course->price, 0, '', ',') }} đ
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
@endsection
