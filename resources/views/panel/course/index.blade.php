@extends('panel.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/typography.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/katex.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css') }}" />
@endsection
@section('content')
    <div class="section-header">
        <h1>Danh sách khóa học</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="text-right">
                            <button type="button" class="create-course btn btn-outline-primary" data-bs-toggle="modal"
                                data-bs-target="#create-course">
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
                                    <th class="text-left">Tiêu đề</th>
                                    <th class="text-left">Giảng viên</th>
                                    <th>Giá</th>
                                    <th>Học viên</th>
                                    <th>Ngày tạo</th>
                                    <th>Trạng thái</th>
                                    <th width="120">Hành động</th>
                                </tr>
                                @foreach ($courses as $course)
                                    <tr>
                                        <td>
                                            <strong>
                                                {{-- <a href="{{ route('learn.index', $course->id) }}">{{ $course->title }}</a> --}}
                                                <a href="{{ route('FE.course_detail', $course->id) }}">{{ $course->title }}</a>
                                            </strong>
                                            <div class="text-small">
                                                {{ empty($course->category) ? '' : $course->category->name }}</div>
                                        </td>
                                        <td class="text-left">{{ $course->user->name }}</td>
                                        <td>{{ $course->price == 0 ? 'Miễn phí' : number_format($course->price, 0, '', '.') }}
                                            VND
                                        </td>
                                        <td class="font-12">
                                            <a href="#" target="_blank" class="">3</a>
                                        </td>
                                        <td class="font-12">
                                            {{ \Carbon\Carbon::parse($course->created_at)->format('d/m/Y') }}</td>

                                        <td>
                                            <div
                                                class="{{ $course->status == 1 ? 'badge bg-label-success me-1' : 'badge bg-label-warning me-1' }}">
                                                {{ $course->status == 1 ? 'Đang hoạt động' : 'Ngưng hoạt động' }}</div>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown"><i
                                                        class="bx bx-dots-vertical-rounded"></i></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item "
                                                        href="{{ route('course.edit', $course->id) }}"><i
                                                            class="bx bx-edit-alt me-1"></i>Edit</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('module.index', $course->id) }}"><i
                                                            class="bx bx-bookmarks me-1"></i>
                                                        Module</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('course.delete', $course->id) }}"><i
                                                            class="bx bx-trash me-1"></i>
                                                        Delete</a>
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
{{-- Tạo khóa học --}}
<div class="modal fade" id="create-course" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Tạo khóa học</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('course.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="title" class="form-label">Tên tiêu đề:</label>
                            <input required type="text" id="title" class="form-control" name='title'
                                placeholder="Enter Name" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <div class="form-group mb-3">
                                <label class="input-label">Danh mục:</label>
                                <select name="category_id" data-search-option="just_teacher_role"
                                    class="form-control my-2 search-user-select2" data-placeholder="Chọn danh mục">
                                    <option disabled></option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label class="input-label">Mô tả:</label>
                            <textarea name="description" class="form-control @error('description')  is-invalid @enderror"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label class="input-label">Ảnh:</label>
                            <input required name="image" type="file"
                                class="form-control @error('description')  is-invalid @enderror">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label class="input-label">Hình nền:</label>
                            <input required name="background" type="file"
                                class="form-control @error('description')  is-invalid @enderror">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label class="input-label">video:</label>
                            <input required name="video" type="file"
                                class="form-control @error('description')  is-invalid @enderror">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="price">Giá:</label>
                            <input required type="number" name="price" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="instructor">Giảng viên:</label>
                            <select name="instructor_id" data-search-option="just_teacher_role"
                                class="form-control my-2 search-user-select2" data-placeholder="Chọn giảng viên">
                                @foreach ($instructors as $instructor)
                                    <option value="{{ $instructor->id }}">{{ $instructor->name }}</option>
                                @endforeach
                            </select>
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

{{-- Update khóa học --}}
<div class="modal fade" id="edit-category" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Tạo danh mục</h5>
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
    <script src="/ckeditor/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('textarea[name="description"]'), {
               toolbarGroups: [
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		'/',
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'others', groups: [ 'others' ] },
		{ name: 'about', groups: [ 'about' ] }
	]
            })
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
