@extends('panel.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" />
@endsection
@section('content')
    <div class="mb-4">
        <div class="d-flex justify-content-between">
            <h2>Danh sách bài tập</h2>
            <a class="btn btn-primary create-quiz d-flex align-items-center" data-bs-toggle="modal"
                data-bs-target="#create-quiz" href="{{ route('quiz.store', ['module_id' => request()->module_id]) }}"><i
                    class="bx bx-book me-1"></i>Thêm bài tập</a>
        </div>
    </div>
    @foreach ($quizzes as $quiz)
        <div class="itembaitap">
            <div class="tenbaitap">
                <h5 class="mb-0">Tên bài tập: {{ $quiz->name }}</h5>
                <a href="{{ route('quiz.edit', $quiz->id) }}" class="btn btn-warning">Sửa bài tập</a>
            </div>
            <div class="cauhoi row mb-4">
                @if ($quiz->questions)
                    @foreach ($quiz->questions as $question)
                        <div class="row mb-3">
                            <div class="col">
                                <input type="text" class="form-control" name="questions[{{ $question->id }}][text]"
                                    disabled placeholder="{{ $question->question }}">
                            </div>
                            @if ($question->answers)
                                @foreach ($question->answers as $answer)
                                    <div class="col">
                                        <input type="text" class="form-control {{ $answer->is_correct == 1 ? 'bg-primary' : '' }}"
                                            name="questions[{{ $answer->question_id }}][answers][0][text]"disabled
                                            placeholder="{{ $answer->text }}">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    @endforeach

    
    <div class="modal fade" id="create-quiz" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Tạo bài tập</h5>
                    <button class="btn btn-primary" type="button" onclick="addField()">+</button>
                </div>
                <form action="{{ route('quiz.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="col mb-3">
                            <label for="name" class="form-label">Tên bài quiz:</label>
                            <input required type="text" id="name" class="form-control" name="name"
                                placeholder="Nhập tên bài quiz" required />
                        </div>
                        <div class="field-input-land">
                            <div class="row mb-3">
                                <!-- Placeholder for question fields -->
                            </div>
                        </div>
                    </div>
                    <input required type="hidden" name="module_id" value="{{ request()->module_id }}">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tạo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
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

                // Thêm thẻ div với class "form-check"
                var formCheckDiv = document.createElement('div');
                formCheckDiv.className = 'form-check';

                var inputRadio = document.createElement('input');
                inputRadio.type = 'radio';
                inputRadio.className = 'form-check-input'; // Thay đổi className của input radio
                inputRadio.name = 'questions[' + container.querySelectorAll('.row.mb-3').length + '][correct_answer]';
                inputRadio.value = i.toString();
                inputRadio.required = true;
                formCheckDiv.appendChild(inputRadio);
                
                var inputAnswer = document.createElement('input');
                inputAnswer.type = 'text';
                inputAnswer.className = 'form-control';
                inputAnswer.name = 'questions[' + container.querySelectorAll('.row.mb-3').length + '][answers][' + i + '][text]';
                inputAnswer.placeholder = 'Câu trả lời ' + (i + 1);
                inputAnswer.required = true; // Thêm required vào trường input
                formCheckDiv.appendChild(inputAnswer);

                

                col.appendChild(formCheckDiv);
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