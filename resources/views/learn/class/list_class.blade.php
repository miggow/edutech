<link rel="stylesheet" href="{{ asset('css/custom.css') }}" />
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
                        <!-- Danh sách học sinh -->
                        <div class="danhsachhocsinh">
                            <div class="itemdshs col-2">
                                <a type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    <div>
                                        <div class="avths"><img src=" {{ asset('assets/img/avatars/default.jpg') }}"
                                                alt=""></div>
                                        <p>Tên: Học sinh 1</p>
                                    </div>
                                </a>
                            </div>
                            <div class="itemdshs col-2">
                                <a type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    <div>
                                        <div class="avths"><img src=" {{ asset('assets/img/avatars/default.jpg') }}"
                                                alt=""></div>
                                        <p>Tên: Học sinh 2</p>
                                    </div>
                                </a>
                            </div>
                            <div class=" itemdshs col-2">
                                <a type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    <div>
                                        <div class="avths"><img src=" {{ asset('assets/img/avatars/default.jpg') }}"
                                                alt=""></div>
                                        <p>Tên: Học sinh 3</p>
                                    </div>
                                </a>
                            </div>
                            <div class="itemdshs col-2">
                                <a type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    <div>
                                        <div class="avths"><img src=" {{ asset('assets/img/avatars/default.jpg') }}"
                                                alt=""></div>
                                        <p>Tên: Học sinh 4</p>
                                    </div>
                                </a>
                            </div>
                            <div class="itemdshs col-2">
                                <a type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    <div>
                                        <div class="avths"><img src=" {{ asset('assets/img/avatars/default.jpg') }}"
                                                alt=""></div>
                                        <p>Tên: Học sinh 1</p>
                                    </div>
                                </a>
                            </div>
                            <div class="itemdshs col-2">
                                <a type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    <div>
                                        <div class="avths"><img src=" {{ asset('assets/img/avatars/default.jpg') }}"
                                                alt=""></div>
                                        <p>Tên: Học sinh 1</p>
                                    </div>
                                </a>
                            </div>
                            <div class="itemdshs col-2">
                                <a type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    <div>
                                        <div class="avths"><img src=" {{ asset('assets/img/avatars/default.jpg') }}"
                                                alt=""></div>
                                        <p>Tên: Học sinh 1</p>
                                    </div>
                                </a>
                            </div>
                        </div>

                    </div>
                    {{-- Thảo luận --}}
                    <div class="tab-pane fade h-100" id="navs-pills-justified-profile" role="tabpanel">
                        <div class="thaoluan">
                            <textarea name="" id="" cols="100" rows="5"
                                placeholder="Bạn đang nghĩ gì hãy nói tui nghe"></textarea>
                        </div>
                        <div class="btndang">
                            <a class="btn btn-primary" href="">Đăng</a>
                        </div>
                        <div class="itemthaoluan  card mb-3">
                            <div class="nguoidang">
                                <div class="avtnguoidang"><img src="{{ asset('assets/img/avatars/default.jpg') }}"
                                        alt="" class="card-img-top" alt="..."></div>
                                <div>
                                    <h5 class="card-title">Người đăng</h5>
                                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                </div>

                            </div>
                            <div class="card-body">
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in
                                    to additional content. This content is a little bit longer.</p>

                            </div>
                            <div class="contentbinhluan">
                                <textarea name="" id="" cols="30" rows="1" placeholder="Bình luận"></textarea>
                            </div>
                            <div class="binhluan">
                                <a href="">Bình luận</a>
                            </div>
                        </div>



                    </div>








                    {{-- Tài liệu và bài tập --}}
                    <div class="tab-pane fade" id="navs-pills-justified-messages" role="tabpanel">
                        <p class="demo-inline-spacing">
                        <div class="baitapvenha">
                            <a class="btn btn-primary me-1" data-bs-toggle="collapse" href="#collapseExample"
                                role="button" aria-expanded="false" aria-controls="collapseExample">
                                Bài tập 1
                            </a>
                        </div>
                        </p>
                        <div class="collapse" id="collapseExample">
                            <div class="d-flex p-3 border">
                                <span>
                                    ...
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Học sinh 1</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <p>Email: admin@admin.com</p>
                    <p>Số điện thoại:</p>
                    <p>Địa chỉ</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
