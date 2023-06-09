@extends('panel.app')
@section('content')
    <div class="card p-4">
        <h3 class="fw-bold py-3">Danh sách lớp học</h3>
        <div class="text-right mb-4">
            <button type="button" class="create-class btn btn-outline-primary" data-bs-toggle="modal"
                data-bs-target="#create-class">
                <i class='bx bx-sm  bxs-folder-plus'></i> Thêm
            </button>
            {{-- <a class="create-category btn btn-outline-primary text-center" data-bs-toggle="modal" data-bs-target="#create-category" ><i class='bx bx-md  bxs-folder-plus'></i> Thêm</a> --}}
        </div>
        {{-- @if ($authUser->can('admin_webinars_export_excel')) --}}
        {{-- @endif --}}
        <div class="container">
            <div class="row">
                @foreach ($classes as $class)
                <div class="col-md-4  mb-4">
                    <div class="card" style="min-height: 100%;">
                        <div class="card-body d-flex flex-column mb-3">
                            <h4 class="card-title">{{ $class->name }}</h4>
                            <p class="card-text">{{ $class->description }}</p>
                            <p class="card-text ">Giáo viên: {{ $class->user->name }}</p>
                            <div class="mt-auto p-2"><a href="{{ route('class.show', $class->id) }}" class="btn btn-primary w-100">Chi tiết</a></div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
<div class="modal fade" id="create-class" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Tạo lớp học mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('class.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="name" class="form-label">Tên lớp học:</label>
                            <input required type="text" id="name" class="form-control" name='name'
                                placeholder="Nhập tên lớp học" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="code" class="form-label">Mã lớp học:</label>
                            <input  type="text" id="code" class="form-control" name='code'
                                placeholder="Nhập mã lớp học (bỏ trống sẽ tự tạo)" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="description" class="form-label">Mô tả lớp học:</label>
                            <textarea required type="text" id="description" class="form-control" name='description'
                                placeholder="Nhập mô tả cho lớp học của bạn"></textarea>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Tạo</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- <div class="modal fade" id="edit-user" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Cập nhật người dùng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="status" class="form-label">Trạng thái</label>
                        <select name="status"class="form-select" id="status" aria-label="Default select example">
                            <option value="{{ $user->status }}" disabled>Chọn trạng thái</option>
                            <option value="1">Kích hoạt</option>
                            <option value="0">Ngưng kích hoạt</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="role" class="form-label">Chức vụ</label>
                        <select name="role"class="form-select" id="role" aria-label="Default select example">
                            <option value="{{ $user->role }} " disabled>Chọn chức vụ</option>
                            <option value="0">Học sinh</option>
                            <option value="1">Giáo viên</option>
                            <option value="2">Quản trị viên</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-primary update-user">Save changes</button>
            </div>
        </div>
    </div>
</div>
@section('js')
    <script>
        $(document).ready(function() {
            $('.edit-user').click(function() {
                var userId = $(this).data('id');
                $('#edit-user').find('.update-user').data('id', userId);
            });
            $('.update-user').click(function() {
                var status = $('#status').val();
                var role = $('#role').val();

                // Lấy ID người dùng từ thuộc tính data-id của nút "Save changes"
                var userId = $(this).data('id');
                $.ajax({
                    url: '/panel/user/edit/' +
                        userId, // Thay thế đường dẫn tới tuyến đường user.update tại đây
                    type: 'POST',
                    data: {
                        "status": status,
                        "role": role,
                        "id": userId,
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        $('#edit-user').modal('hide');
                        location.reload();
                        console.log(response); // In ra console để kiểm tra phản hồi
                        // Cập nhật giao diện người dùng nếu cần thiết
                    },
                    error: function(xhr) {
                        // Xử lý lỗi nếu có
                        console.log(xhr.responseText); // In ra console để kiểm tra lỗi
                    }
                });
                // Tiếp tục xử lý yêu cầu AJAX và các bước tiếp theo
                // ...
            });

        });
    </script>
@endsection --}}
