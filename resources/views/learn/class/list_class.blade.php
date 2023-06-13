@extends('learn.layout')
@section('content')
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
                            <div class="itemdshs col-1">
                                <a type="button" class="btn btn-primary bg-dark" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    <div>
                                        <div class="avths my-2"><img src=" {{ asset('assets/img/avatars/default.jpg') }}"
                                                alt=""></div>
                                        <p>Tên: Học sinh 1</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    {{-- Thảo luận --}}
                    <div class="tab-pane fade h-100 px-5 mx-5" id="navs-pills-justified-profile" role="tabpanel">
                        <div class="px-5">
                            <form action="" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="thaoluan">
                                    <textarea class="ckeditor" name="thaoluan" id="thaoluan"></textarea>
                                </div>
                                <div class="btndang my-2">
                                    <a class="btn btn-primary" href="">Đăng</a>
                                </div>
                            </form>
                        </div>
                        <div class="itemthaoluan  card mb-3">
                            <div class="nguoidang pt-3 px-3">
                                <div class="avtnguoidang"><img src="{{ asset('assets/img/avatars/default.jpg') }}"
                                        alt="" class="card-img" alt="..."></div>
                                <div>
                                    <h5 class="card-title">Người đăng</h5>
                                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in
                                    to additional content. This content is a little bit longer.</p>

                            </div>
                            <div class="card-body mx-5 border rounded mb-3">

                                <div class="nguoidang ">
                                    <div class="avtnguoidang"><img src="{{ asset('assets/img/avatars/default.jpg') }}"
                                            alt="" class="card-img" alt="..."></div>
                                    <div>
                                        <h5 class="card-title">Người bình luận</h5>
                                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                    </div>
                                </div>
                                <div class="card-body">
                                    Nội dung bình luận mẫu
                                </div>
                            </div>
                            <div class="mx-5"><form action="#" method="post" enctype="multipart/form-data">
                                {{-- @csrf --}}
                                <textarea class="ckeditor" name="binhluan" id="binhluan"></textarea>
                                <div class="text-end mx-5 mt-3">
                                    <button class="btn btn-primary ">Đăng</button>
                                </div>
                            </form></div>
                            
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
@section('js')
    <script src="/ckeditor/ckeditor.js"></script>
    <script>
        $(document).ready(function() {
            $('.ckeditor').each(function() {
                ClassicEditor
                    .create(this)
                    .then(editor => {
                        // Cấu hình toolbar cho CKEditor
                        editor.ui.getEditableElement().parentElement.insertBefore(
                            editor.ui.view.toolbar.element,
                            editor.ui.getEditableElement()
                        );
                    })
                    .catch(error => {
                        console.error(error);
                    });
            });
        });
    </script>
@endsection
