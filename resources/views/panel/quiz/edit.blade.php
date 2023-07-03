@extends('panel.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" />
@endsection
@section('content')
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel1">Tạo bài tập</h5>
            <button class="btn btn-primary" type="button" onclick="addField()">+</button>
        </div>
        <form action="{{ route('quiz.update', $quiz->id) }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="col mb-3">
                    <label for="name" class="form-label">Tên bài quiz:</label>
                    <input required type="text" id="name" value="{{ $quiz->name }}" class="form-control" name="name" required />
                </div>

                <div class="field-input-land">
                    @if ($quiz->questions)
                        @foreach ($quiz->questions as $index1 => $question)
                            <div class="row mb-3">
                                <div class="col">
                                    <input type="text" class="form-control" value="{{ $question->question }}" name="questions[{{ $index1 }}][text]">
                                </div>
                                @if ($question->answers)
                                    @foreach ($question->answers as $index2 => $answer)
                                        <div class="col">
                                            <div class="form-check">
                                                <input class="form-check-input" {{ $answer->is_correct==1 ? 'checked' : '' }} type="radio" name="questions[{{ $index1 }}][correct_answer]" id="radio{{ $index1 }}{{ $index2 }}" value="{{ $index2 }}">
                                                <input type="text" class="form-control" value="{{ $answer->text }}" name="questions[{{ $index1 }}][answers][{{ $index2 }}][text]">
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <div class="col-auto">
                                    <button class="btn btn-danger" type="button" onclick="removeField(this)">-</button>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <input required type="hidden" name="module_id" value="{{ request()->module_id }}">
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Tạo</button>
            </div>
        </form>
    </div>
@endsection
@section('js')
    <script>
        function addField() {
            var container = document.querySelector('.field-input-land');
            var questionIndex = container.querySelectorAll('.row.mb-3').length;
            var row = document.createElement('div');
            row.className = 'row mb-3';

            // Thêm trường cho câu hỏi
            var colQuestion = document.createElement('div');
            colQuestion.className = 'col';
            var inputQuestion = document.createElement('input');
            inputQuestion.type = 'text';
            inputQuestion.className = 'form-control';
            inputQuestion.name = 'questions[' + questionIndex + '][text]';
            inputQuestion.placeholder = 'Nhập câu hỏi';
            colQuestion.appendChild(inputQuestion);
            row.appendChild(colQuestion);

            for (var i = 0; i < 4; i++) {
                var col = document.createElement('div');
                col.className = 'col';
                var divFormCheck = document.createElement('div');
                divFormCheck.className = 'form-check';
                var inputRadio = document.createElement('input');
                inputRadio.className = 'form-check-input';
                inputRadio.type = 'radio';
                inputRadio.name = 'questions[' + questionIndex + '][correct_answer]';
                inputRadio.id = 'radio' + questionIndex + i;
                inputRadio.value = i;
                var inputAnswer = document.createElement('input');
                inputAnswer.type = 'text';
                inputAnswer.className = 'form-control';
                inputAnswer.placeholder = 'Câu trả lời ' + (i + 1);
                inputAnswer.name = 'questions[' + questionIndex + '][answers][' + i + '][text]';
                divFormCheck.appendChild(inputRadio);
                divFormCheck.appendChild(inputAnswer);
                col.appendChild(divFormCheck);
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
                removeField(this);
            });
            colAuto.appendChild(removeButton);
            row.appendChild(colAuto);

            container.appendChild(row);
        }

        function removeField(button) {
            var row = button.parentNode.parentNode;
            row.remove();
        }
    </script>
@endsection
