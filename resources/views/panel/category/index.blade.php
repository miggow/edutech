@extends('panel.app')
@section('content')
    <div class="section-header">
        <h1>Danh sách danh mục</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="text-right">
                            <button type="button" class="create-category btn btn-outline-primary" data-bs-toggle="modal"
                                data-bs-target="#create-category">
                                <i class='bx bx-sm  bxs-folder-plus'></i> Thêm
                            </button>
                            {{-- <a class="create-category btn btn-outline-primary text-center" data-bs-toggle="modal" data-bs-target="#create-category" ><i class='bx bx-md  bxs-folder-plus'></i> Thêm</a> --}}
                        </div>
                        {{-- @if ($authUser->can('admin_webinars_export_excel')) --}}
                        {{-- @endif --}}
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped font-14 ">
                                <tr>
                                    <th>ID</th>
                                    <th class="text-left">Tên danh mục</th>
                                    <th class="text-left">Người tạo</th>
                                    <th>Ngày tạo</th>
                                    <th width="120">Hành động</th>
                                </tr>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>
                                            {{ $category->name }}
                                        </td>
                                        <td>{{ $category->user->name ?? '' }}</td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($category->created_at)->format('d/m/Y') }}</td>


                                        <td>
                                            
                                                <div class="row">
                                                    <a class="col-1 edit-category " title="Chỉnh sửa" data-bs-toggle="modal"
                                                        data-bs-target="#edit-category" data-id="{{ $category->id }}"
                                                        data-name="{{ $category->name }}"><i
                                                            class="bx bx-edit-alt text-primary "></i></a>

                                                    <a class="col-1" title="Xóa"
                                                        href="{{ route('category.destroy', $category->id) }}"><i
                                                            class="bx bx-trash "></i>
                                                        </a>
                                                </div>
                                         
                                        </td>
                                    </tr>
                                @endforeach


                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
<div class="modal fade" id="create-category" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Tạo danh mục</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('category.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="name" class="form-label">Tên danh mục</label>
                            <input required type="text" id="name" class="form-control" name='name'
                                placeholder="Enter Name" />
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
<div class="modal fade" id="edit-category" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Sửa danh mục</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="name1" class="form-label">Tên danh mục</label>
                        <input required type="text" id="name1" class="form-control" name='name1'
                            placeholder="Enter Name" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="submit" class="btn btn-primary update-category">Cập nhật</button>
            </div>
        </div>
    </div>
</div>
@section('js')
    <script>
        $(document).ready(function() {
            $('.edit-category').click(function() {
                var id = $(this).data('id');
                $('#edit-category').find('.update-category').data('id', id);
            });
            $('.update-category').click(function() {
                var name = $('#name1').val();

                // Lấy ID người dùng từ thuộc tính data-id của nút "Save changes"
                var id = $(this).data('id');
                $.ajax({
                    url: '/panel/category/update/' + id,
                    type: 'POST',
                    data: {
                        "id": id,
                        "name": name,
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        $('#edit-category').modal('hide');
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
