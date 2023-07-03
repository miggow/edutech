@extends('panel.app')
@section('content')
    <div class="section-header">
        <h1>Danh sách bài giảng</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{-- @if ($authUser->can('admin_webinars_export_excel')) --}}
                        <button type="button" class="create-lesson btn btn-outline-primary" data-bs-toggle="modal"
                            data-bs-target="#create-lesson">
                            <i class='bx bx-sm  bxs-folder-plus'></i> Thêm
                        </button>
                        {{-- @endif --}}
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped font-14 ">
                                <tr>
                                    <th>ID</th>
                                    <th class="text-left">Tên bài giảng</th>
                                    <th>Mô tả</th>
                                    <th>Ngày tạo</th>
                                    <th width="120">Hành động</th>
                                </tr>
                                @foreach ($lessons as $lesson)
                                    <tr class="text-left">
                                        <td>{{ $lesson->id }}</td>
                                        <td width="18%" class="text-left">
                                            {{ $lesson->name }}
                                        </td>
                                        <td>
                                            {!! $lesson->description !!} 
                                        </td>
                                        <td class="font-12">
                                            {{ \Carbon\Carbon::parse($lesson->created_at)->format('d/m/Y') }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown"><i
                                                        class="bx bx-dots-vertical-rounded"></i></button>
                                                <div class="dropdown-menu">
                                                    
                                                    <a class="dropdown-item " 
                                                        href="{{ route('lesson.edit', $lesson->id) }}"><i
                                                            class="bx bx-edit-alt me-1"></i>Sửa</a>

                                                    <a class="dropdown-item"
                                                        href="{{ route('lesson.delete', $lesson->id) }}"><i
                                                            class="bx bx-trash me-1"></i>
                                                        Xóa</a>
                                                </div>
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
<div class="modal fade" id="create-lesson" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Tạo khóa học</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('lesson.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="name" class="form-label">Tên bài giảng:</label>

                            <input required type="text" id="name" class="form-control" name='name'
                                placeholder="Nhập tên bài giảng" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label class="input-label">video:</label>
                            <input required name="video" type="file"
                                class="form-control">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Mô tả</label>
                        {{-- <textarea class="form-control" id="description" name="description" required></textarea> --}}
                        <textarea class="ckeditor" name="description" id="description" ></textarea>

                    </div>
                    
                </div>
                <input required type="hidden" name="module_id" value="{{ $module->id }}">
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