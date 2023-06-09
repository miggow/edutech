@extends('learn.layout')
@section('content')
    @php
        if (Auth::user()->role == 2) {
            $isAdmin = 1;
        } else {
            $isAdmin = 0;
        }
    @endphp
    <div class="row h-100">
        <div class="col-xl-12 p-3">
            <div class="nav-align-top ">
                <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-justified-list-student"
                            aria-controls="navs-pills-justified-list-student" aria-selected="true">
                            <i class="tf-icons bx bx-home"></i> Danh sách học sinh
                            <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger">3</span>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-justified-profile" aria-controls="navs-pills-justified-profile"
                            aria-selected="false">
                            <i class="tf-icons bx bx-user"></i> Thảo luận
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-justified-messages" aria-controls="navs-pills-justified-messages"
                            aria-selected="false">
                            <i class="tf-icons bx bx-message-square"></i> Tài liệu & Bài tập
                        </button>
                    </li>
                </ul>
                <div class="tab-content" style="background: unset; box-shadow: unset">
                    <div class="tab-pane fade show active" id="navs-pills-justified-list-student" role="tabpanel">
                        <p>
                            Icing pastry pudding oat cake. Lemon drops cotton candy caramels cake caramels sesame snaps
                            powder. Bear claw candy topping.
                        </p>
                        <p class="mb-0">
                            Tootsie roll fruitcake cookie. Dessert topping pie. Jujubes wafer carrot cake jelly. Bonbon
                            jelly-o jelly-o ice cream jelly beans candy canes cake bonbon. Cookie jelly beans
                            marshmallow
                            jujubes sweet.
                        </p>
                    </div>
                    <div class="tab-pane fade h-100" id="navs-pills-justified-profile" role="tabpanel">
                        <h1>aaaaaaa</h1>
                    </div>
                    <div class="tab-pane fade" id="navs-pills-justified-messages" role="tabpanel">
                        <p>
                            Oat cake chupa chups dragée donut toffee. Sweet cotton candy jelly beans macaroon gummies
                            cupcake gummi bears cake chocolate.
                        </p>
                        <p class="mb-0">
                            Cake chocolate bar cotton candy apple pie tootsie roll ice cream apple pie brownie cake.
                            Sweet
                            roll icing sesame snaps caramels danish toffee. Brownie biscuit dessert dessert. Pudding
                            jelly
                            jelly-o tart brownie jelly.
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
