@extends('panel.app')
@section('content')

<div class="card p-4">
        <h4 class="fw-bold py-3 mb-4">Danh sách người dùng</h4>
        <div class="table-responsive text-nowrap">
            <table class="table " id="user-table">
                <thead class="table-light">
                    <tr>
                        <th>Họ và tên</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Chức vụ</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone ?? '' }}</td>
                            <td>
                                @if ($user->role == 0)
                                    Học sinh
                                @elseif ($user->role == 1)
                                    Giảng viên
                                @elseif($user->role == 2)
                                    Quản trị viên
                                @endif
                            </td>
                            <td>
                                @if ($user->status == 0)
                                    <span class="badge bg-label-warning me-1">Ngưng hoạt động</span>
                                @else
                                    <span class="badge bg-label-primary me-1">Hoạt động</span>
                                @endif


                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item edit-user" data-bs-toggle="modal"
                                            data-bs-target="#edit-user" data-id="{{ $user->id }}"><i
                                                class="bx bx-edit-alt me-1"></i>Edit</a>

                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i>
                                            Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
                {{-- <tfoot class="table-border-bottom-0">
                    <tr>
                        <th>Họ và tên</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Chức vụ</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </tfoot> --}}
            </table>
        </div>
    </div>
@endsection
<div class="modal fade" id="edit-user" tabindex="-1" aria-hidden="true">
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
@endsection
