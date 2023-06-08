@extends('panel.app')
@section('content')
    <div class="section-header">
        <h1>Sửa khóa học</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12 ">
                <div class="card">
                    <div class="card-body">

                        <form method="POST" action="{{ route('course.update', $course->id) }}"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <section>
                                <h2 class="section-title after-line">Thông tin cơ bản</h2>

                                <div class="row">
                                    <div class="col-12 col-md-5">


                                        {{-- <div class="form-group mb-3 ">
                                                <label class="input-label d-block">{{ trans('lms/panel.course_type') }}</label>

                                                <select name="type" class="custom-select @error('type')  is-invalid @enderror">
                                                    <option value="webinar" @if (!empty($webinar) and $webinar->isWebinar() or old('type') == \App\Models\LMS\Webinar::$webinar) selected @endif>{{ trans('lms/webinars.webinar') }}</option>
                                                    <option value="course" @if (!empty($webinar) and $webinar->isCourse() or old('type') == \App\Models\LMS\Webinar::$course) selected @endif>{{ trans('lms/product.video_course') }}</option>
                                                    <option value="text_lesson" @if (!empty($webinar) and $webinar->isTextCourse() or old('type') == \App\Models\LMS\Webinar::$textLesson) selected @endif>{{ trans('lms/product.text_course') }}</option>
                                                </select>

                                                @error('type')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div> --}}

                                        <div class="form-group mb-3">
                                            <label class="input-label">Tiêu đề</label>
                                            <input required type="text" name="title" value="{{ $course->title }}"
                                                class="form-control @error('title')  is-invalid @enderror" placeholder="" />
                                            @error('title')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>


                                        <div class="form-group mb-3 ">
                                            <label for="instructor">Giảng viên:</label>
                                            <select name="instructor_id" data-search-option="just_teacher_role"
                                                class="form-control my-2 search-user-select2" data-placeholder="Chọn giảng viên">
                                                <option disabled></option>
                                                @foreach ($instructors as $instructor)
                                                    <option value="{{ $instructor->id }}">{{ $instructor->name }}</option>
                                                @endforeach
                                            </select>

                                        </div>



                                        <div class="form-group mb-3">
                                            @if (!empty($course->image))
                                                <div class="mb-2 card-img">
                                                    <img src="{{ asset($course->image) }}" class="card-img"
                                                        for="image" alt="">
                                                </div>
                                            @endif
                                            <label class="input-label">Ảnh thu nhỏ (thumbnail)</label>
                                            <div class="input-group">
                                                <div class="form-group">
                                                    <input required type="file" name="image" class="form-control"
                                                        id="image">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group mb-3">
                                            @if (!empty($course->background))
                                                <div class="mb-2 card-img">
                                                    <img src="{{ asset($course->background) }}" class="card-img"
                                                        width="100" alt="">
                                                </div>
                                            @endif
                                            <label class="input-label">Ảnh bìa</label>
                                            <div class="input-group">
                                                <div class="form-group">
                                                    <input required type="file" value="{{ asset($course->background) }}"
                                                        name="background" class="form-control" id="background">

                                                </div>
                                            </div>
                                        </div>



                                        <div class="form-group mb-3">
                                            @if (!empty($course->video))
                                                <div class="mb-2 card-img">
                                                    <video width="640" height="360" controls>
                                                        <source src="{{ asset($course->video) }}" type="video/mp4">
                                                    </video>
                                                </div>
                                            @endif
                                            <div class="input-group">
                                                <div class="form-group">
                                                    <input required type="file" name="video" class="form-control" id="video"
                                                        value="{{ $course->video ?? '' }}">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row ">
                                    <div class="col-12">
                                        <div class="form-group mb-3">
                                            <label class="input-label">Mô tả</label>
                                            <textarea name="description" class="form-control @error('description')  is-invalid @enderror">{{ $course->description }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <section class="mt-3">
                                <h2 class="section-title after-line">Thông tin bổ sung</h2>
                                <div class="row">
                                    <div class="col-12 col-md-6">

                                        


                                        <div class="form-group mb-3">
                                            <label class="input-label">Giá</label>
                                            {{-- value="{{ !empty($webinar) ? $webinar->price : old('price') }}" --}}
                                            <input required type="text" name="price" value="{{ $course->price }}"
                                                class="form-control @error('price')  is-invalid @enderror"
                                                placeholder="Nhập 0 nếu là khóa học miễn phí" />
                                            {{-- @error('price')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror --}}
                                        </div>
                                       



                                        <div class="form-group mb-3">
                                            <label class="input-label">Danh mục</label>

                                            <select name="category" data-search-option="just_teacher_role"
                                                class="form-control search-user-select2" data-placeholder="Chọn danh mục">
                                                {{-- {{ !empty($webinar) ? '' : 'selected' }} --}}
                                                <option disabled></option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </section>
                            <button type="submit" class="btn btn-primary">Lưu và tiếp tục</button>
                        </form>
                    </div>
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
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'blockQuote']
            })
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
