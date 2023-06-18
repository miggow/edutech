@extends('panel.app')
@section('content')
    <div class="section-header">
        <h1>Danh sách module</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{-- @if ($authUser->can('admin_webinars_export_excel')) --}}
                        <button type="button" class="create-module btn btn-outline-primary" data-bs-toggle="modal"
                            data-bs-target="#create-module">
                            <i class='bx bx-sm  bxs-folder-plus'></i> Thêm
                        </button>
                        {{-- @endif --}}
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped font-14 ">
                                <tr>
                                    <th>ID</th>
                                    <th class="text-left">Tên module</th>
                                    <th>Thời lượng</th>
                                    <th>Ngày tạo</th>
                                    <th width="120">Hành động</th>
                                </tr>
                                @foreach ($modules as $module)
                                    <tr class="text-left">
                                        <td>{{ $module->id }}</td>
                                        <td width="18%" class="text-left">
                                            {{ $module->name }}
                                        </td>
                                        <td>
                                            {{ $module->duration }} phút
                                        </td>
                                        <td class="font-12">
                                            {{ \Carbon\Carbon::parse($module->created_at)->format('d/m/Y') }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown"><i
                                                        class="bx bx-dots-vertical-rounded"></i></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item "
                                                        href="{{ route('module.edit', $module->id) }}"><i
                                                            class="bx bx-edit-alt me-1"></i>Edit</a>
                                                            <a class="dropdown-item "
                                                                href="{{ route('lesson.index', $module->id) }}"><i
                                                                    class="bx bx-book-open me-1"></i>Bài giảng</a>

                                                    <a class="dropdown-item create-quiz" data-bs-toggle="modal"
                                                        data-bs-target="#create-quiz"
                                                        href="{{ route('quiz.store', ['module_id' => $module->id]) }}"><i
                                                            class="bx bx-book me-1"></i>Thêm bài tập</a>
                                                            
                                                    <a class="dropdown-item create-quiz"
                                                        href="{{ route('quiz.index') }}"><i
                                                            class="bx bx-book me-1"></i>Quản lý bài tập</a>


                                                    <a class="dropdown-item"
                                                        href="{{ route('module.delete', $module->id) }}"><i
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
<div class="modal fade" id="create-module" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Tạo khóa học</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('module.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="name" class="form-label">Tên module:</label>

                            <input required type="text" id="name" class="form-control" name='name'
                                placeholder="Enter Name" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="">Thời gian (phút):</label>
                            <div class="input-group my-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="timeInputGroupPrepend">
                                        <i class='bx bx-sm bxs-time'></i>
                                    </span>
                                </div>
                                <input required type="text" name="duration"
                                    class="form-control @error('duration')  is-invalid @enderror" />
                            </div>
                        </div>
                    </div>
                </div>
                <input required type="hidden" name="course_id" value="{{ $course->id }}">
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

<div class="modal fade" id="create-quiz" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Tạo khóa học</h5>
                <button class="btn btn-primary" type="button" onclick="addField()">+</button>
            </div>
            <form action="{{ route('quiz.store') }}" method="post">
                @csrf
                <div class="modal-body">
                     <div class="col mb-3">
                            <label for="name" class="form-label">Tên bài quiz:</label>

                            <input required type="text" id="name" class="form-control" name='name'
                                placeholder="Nhập tên bài quiz" required />
                        </div>
                    <div class="field-input-land">
                        <div class="row mb-3">
                            
                        </div>
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
    <script>
        function addField() {
            var container = document.querySelector('.field-input-land');
            var row = document.createElement('div');
            row.className = 'row mb-3';

            // Thêm trường cho câu hỏi
            var colQuestion = document.createElement('div');
            colQuestion.className = 'col';
            var inputQuestion = document.createElement('input');
            inputQuestion.type = 'text';
            inputQuestion.className = 'form-control';
            inputQuestion.name = 'questions[' + container.querySelectorAll('.row.mb-3').length + '][text]';
            inputQuestion.placeholder = 'Nhập câu hỏi';
            colQuestion.appendChild(inputQuestion);
            row.appendChild(colQuestion);

            // Thêm trường cho đáp án và radio button
            for (var i = 0; i < 4; i++) {
                var col = document.createElement('div');
                col.className = 'col';
                var inputAnswer = document.createElement('input');
                inputAnswer.type = 'text';
                inputAnswer.className = 'form-control';
                inputAnswer.name = 'questions[' + container.querySelectorAll('.row.mb-3').length + '][answers][' + i + '][text]';
                inputAnswer.placeholder = 'Câu trả lời ' + (i + 1);
                col.appendChild(inputAnswer);
                var inputRadio = document.createElement('input');
                inputRadio.type = 'radio';
                inputRadio.name = 'questions[' + container.querySelectorAll('.row.mb-3').length + '][correct_answer]';
                inputRadio.value = i.toString();
                col.appendChild(inputRadio);
                row.appendChild(col);
            }

            // Thêm nút xóa câu hỏi
            var colAuto = document.createElement('div');
            colAuto.className = 'col-auto';
            var removeButton = document.createElement('button');
            removeButton.className = 'btn btn-danger';
            removeButton.textContent = '-';
            removeButton.type = 'button';
            removeButton.addEventListener('click', function() {
                removeField(row);
            });
            colAuto.appendChild(removeButton);
            row.appendChild(colAuto);

            container.appendChild(row);
        }

        function removeField(row) {
            row.remove();
        }
    </script>
@endsection
