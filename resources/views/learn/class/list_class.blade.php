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
                            @foreach ($users as $key => $user)
                                <div class="itemdshs col-1">
                                    <a type="button" class="btn btn-primary bg-dark" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal" data-name="{{ $user->name }}"
                                        data-email="{{ $user->email }}" data-phone="{{ $user->phone }}"
                                        data-address="{{ $user->address }}">
                                        <div>
                                            <div class="avths my-2"><img src="{{ asset($user->image) }}" alt="">
                                            </div>
                                            <p>{{ $user->name }}</p>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    {{-- Thảo luận --}}
                    <div class="tab-pane fade h-100 px-5 mx-5" id="navs-pills-justified-profile" role="tabpanel">

                        <div class="card p-3 my-4">
                            <form action="{{ route('post_store', ['class_id' => $class->id]) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="thaoluan">
                                    <textarea class="ckeditor" name="thaoluan" id="thaoluan"></textarea>
                                </div>
                                <div class="btndang my-2">
                                    <button class="btn btn-primary">Đăng</button>
                                </div>
                            </form>
                        </div>
                        @if ($posts)
                            @foreach ($posts as $post)
                                <div class="itemthaoluan  card mb-3">
                                    <div class="nguoidang pt-3 px-3">
                                        <div class="avtnguoidang"><img src="{{ asset($post->user->image) }}" alt=""
                                                class="card-img" alt="..."></div>
                                        <div>
                                            <h5 class="card-title">{{ $post->user->name }}</h5>
                                            <p class="card-text"><small
                                                    class="text-muted">{{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y') }}</small>
                                            </p>
                                        </div>
                                        <div class="position-absolute top-0 end-0 p-3">
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown"><i
                                                        class="bx bx-dots-vertical-rounded"></i></button>
                                                <div class="dropdown-menu">

                                                    <a class="dropdown-item"
                                                        href="{{ route('delele_post', $post->id) }}"><i
                                                            class="bx bx-trash me-1"></i>
                                                        Xóa</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">{!! $post->content !!}</p>
                                    </div>
                                    @if ($post->commentPosts)
                                        @foreach ($post->commentPosts as $item)
                                            <div class="card-body mx-5 border rounded mb-3">

                                                <div class="nguoidang ">
                                                    <div class="avtnguoidang"><img src="{{ asset($item->user->image) }}"
                                                            alt="" class="card-img" alt="..."></div>
                                                    <div>
                                                        <h5 class="card-title">{{ $item->user->name }}</h5>
                                                        <p class="card-text"><small
                                                                class="text-muted">{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}</small>
                                                        </p>
                                                    </div>
                                                    <div class="dropdown order-last">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown"><i
                                                                class="bx bx-dots-vertical-rounded"></i></button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item"
                                                                href="{{ route('delele_comment', $item->id) }}"><i
                                                                    class="bx bx-trash me-1"></i>
                                                                Xóa</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    {!! $item->content !!}
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif

                                    <div class="mx-5">
                                        <form action="{{ route('comment_store', ['post_id' => $post->id]) }}"
                                            method="post" enctype="multipart/form-data">
                                            @csrf
                                            <textarea class="ckeditor" name="binhluan" id="binhluan"></textarea>
                                            <div class="text-end mx-5 mt-3">
                                                <button class="btn btn-primary ">Đăng</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            @endforeach
                        @else
                        @endif


                    </div>
                    {{-- Tài liệu và bài tập --}}
                    <div class="tab-pane fade px-5 mx-5" id="navs-pills-justified-messages" role="tabpanel">
                        @php
                            if(Auth::user()->id == $class->user_id || auth()->user()->role ==2)
                            {
                                $is_create = 1;
                            }
                            else {
                                $is_create = 0;
                            }
                        @endphp
                        @if ($is_create == 1 )
                            <div class="card p-3 my-4">
                            <form action="{{ route('documents.upload', ['classRoomId' => $class->id]) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="title" class="form-label">Tiêu đề</label>
                                    <input type="text" class="form-control" id="title" name="title" required>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Mô tả</label>
                                    <textarea class="form-control" id="description" name="description" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="file" class="form-label">Tệp đính kèm</label>
                                    <input type="file" class="form-control" id="file" name="file" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Đăng tải</button>
                            </form>
                        </div>
                        @endif
                        <h3>Danh sách cách bài giảng</h3>
                        @if ($class->documents)
                            @foreach ($class->documents as $key => $item)
                                <div class="baitapvenha mt-2">
                                    <a class="btn btn-primary me-1 text-start" data-bs-toggle="collapse"
                                        href="#collapseExample-{{ $key }}" role="button" aria-expanded="false"
                                        aria-controls="collapseExample-{{ $key }}">
                                        {{ $item->title }}
                                    </a>
                                </div>

                                <div class="collapse" id="collapseExample-{{ $key }}">
                                    <div class="p-3 border">
                                        <p>{{ $item->description }}</p>
                                        <a href="/storage/documents/{{ $item->file_path }}">Mở thư mục</a>
                                    </div>

                                </div>
                            @endforeach
                        @endif


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
                    <h5 class="modal-title" id="exampleModalLabel">Thông tin người dùng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Tên:</strong> <span id="modal-name"></span></p>
                    <p><strong>Email:</strong> <span id="modal-email"></span></p>
                    <p><strong>Số điện thoại:</strong> <span id="modal-phone"></span></p>
                    <p><strong>Địa chỉ:</strong> <span id="modal-address"></span></p>
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
    <script>
        // Xử lý sự kiện khi nút mở modal được nhấp
        $('.btn-primary').on('click', function() {
            var name = $(this).data('name');
            var email = $(this).data('email');
            var phone = $(this).data('phone');
            var address = $(this).data('address');

            // Cập nhật nội dung của modal với thông tin người dùng tương ứng
            $('#modal-name').text(name);
            $('#modal-email').text(email);
            $('#modal-phone').text(phone);
            $('#modal-address').text(address);
        });
    </script>
@endsection
