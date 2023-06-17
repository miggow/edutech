@extends('panel.app')
@section('content')
    <div class="row">
        <div class="col-12 ">
            <div class="card">
                <div class="card-body">

                    <form method="post" action="{{ route('lesson.update', $lesson->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col mb-3">
                                <label for="name" class="form-label">Tên bài giảng:</label>

                                <input required type="text" id="name" class="form-control" name='name'
                                    value="{{ $lesson->name }}" placeholder="Nhập tên bài giảng" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                @if (!empty($lesson->video))
                                    <div class="mb-2 card-img">
                                        <video width="640" height="360" controls>
                                            <source src="{{ asset($lesson->video) }}" type="video/mp4">
                                        </video>
                                    </div>
                                @endif
                                <label class="input-label">video:</label>
                                <input required name="video" type="file" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="input-label">Mô tả:</label>
                                <textarea name="description" class="form-control " required>
                                {!! $lesson->description !!}</textarea>
                            </div>
                        </div>
                        <input required type="hidden" name="module_id" value="{{ $lesson->module_id }}">
                        <button type="submit" class="btn btn-primary">Lưu và tiếp tục</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="/ckeditor/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('textarea[name="description"]'), {
                toolbar: ['undo', 'redo',
                    '|', 'heading',
                    '|', 'fontfamily', 'fontsize', 'fontColor', 'fontBackgroundColor',
                    '|', 'bold', 'italic', 'strikethrough', 'subscript', 'superscript', 'code',
                    '-', // break point
                    '|', 'alignment',
                    'link', 'uploadImage', 'blockQuote', 'codeBlock',
                    '|', 'bulletedList', 'numberedList', 'todoList', 'outdent', 'indent'
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