<link rel="stylesheet" href="{{ asset('css/custom.css') }}" />
@extends('panel.app')
@section('content')
    <h1>Danh sách bài tập</h1>
    <div class="itembaitap">
        <div class="tenbaitap">
            <h5 class="mb-0">Tên bài tập: </h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exLargeModal">
                Sửa
            </button>
        </div>
        <div class="cauhoi row mb-4">
            <div class="row mb-3">
                <div class="col"><input type="text" class="form-control" name="questions[1][text]" disabled
                        placeholder="Câu hỏi"></div>
                <div class="col"><input type="text" class="form-control" name="questions[1][answers][0][text]"disabled
                        placeholder="Câu trả lời 1"><input type="radio" name="questions[1][correct_answer]"
                        value="0"></div>
                <div class="col"><input type="text" class="form-control" name="questions[1][answers][1][text]"disabled
                        placeholder="Câu trả lời 2"><input type="radio" name="questions[1][correct_answer]"
                        value="1"></div>
                <div class="col"><input type="text" class="form-control" name="questions[1][answers][2][text]"disabled
                        placeholder="Câu trả lời 3"><input type="radio" name="questions[1][correct_answer]"
                        value="2"></div>
                <div class="col"><input type="text" class="form-control" name="questions[1][answers][3][text]"disabled
                        placeholder="Câu trả lời 4"><input type="radio" name="questions[1][correct_answer]"
                        value="3"></div>
            </div>
        </div>
        <div class="cauhoi row mb-4">
            <div class="row mb-3">
                <div class="col"><input type="text" class="form-control" name="questions[1][text]"disabled
                        placeholder="Câu hỏi"></div>
                <div class="col"><input type="text" class="form-control" name="questions[1][answers][0][text]"disabled
                        placeholder="Câu trả lời 1"><input type="radio" name="questions[1][correct_answer]"
                        value="0"></div>
                <div class="col"><input type="text" class="form-control" name="questions[1][answers][1][text]"disabled
                        placeholder="Câu trả lời 2"><input type="radio" name="questions[1][correct_answer]"
                        value="1"></div>
                <div class="col"><input type="text" class="form-control" name="questions[1][answers][2][text]"disabled
                        placeholder="Câu trả lời 3"><input type="radio" name="questions[1][correct_answer]"
                        value="2"></div>
                <div class="col"><input type="text" class="form-control" name="questions[1][answers][3][text]"disabled
                        placeholder="Câu trả lời 4"><input type="radio" name="questions[1][correct_answer]"
                        value="3"></div>
            </div>
        </div>
    </div>
    <div class="itembaitap">
        <div class="tenbaitap">
            <h5 class="mb-0">Tên bài tập: </h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exLargeModal">
                Sửa
            </button>
        </div>
        <div class="cauhoi row mb-4">
            <div class="row mb-3">
                <div class="col"><input type="text" class="form-control" name="questions[1][text]"disabled
                        placeholder="Nhập câu hỏi"></div>
                <div class="col"><input type="text" class="form-control" name="questions[1][answers][0][text]"disabled
                        placeholder="Câu trả lời 1"><input type="radio" name="questions[1][correct_answer]"
                        value="0"></div>
                <div class="col"><input type="text" class="form-control" name="questions[1][answers][1][text]"disabled
                        placeholder="Câu trả lời 2"><input type="radio" name="questions[1][correct_answer]"
                        value="1"></div>
                <div class="col"><input type="text" class="form-control" name="questions[1][answers][2][text]"disabled
                        placeholder="Câu trả lời 3"><input type="radio" name="questions[1][correct_answer]"
                        value="2"></div>
                <div class="col"><input type="text" class="form-control" name="questions[1][answers][3][text]"disabled
                        placeholder="Câu trả lời 4"><input type="radio" name="questions[1][correct_answer]"
                        value="3"></div>
            </div>
        </div>
        <div class="cauhoi row mb-4">
            <div class="row mb-3">
                <div class="col"><input type="text" class="form-control" name="questions[1][text]"disabled
                        placeholder="Nhập câu hỏi"></div>
                <div class="col"><input type="text" class="form-control" name="questions[1][answers][0][text]"disabled
                        placeholder="Câu trả lời 1"><input type="radio" name="questions[1][correct_answer]"
                        value="0"></div>
                <div class="col"><input type="text" class="form-control" name="questions[1][answers][1][text]"disabled
                        placeholder="Câu trả lời 2"><input type="radio" name="questions[1][correct_answer]"
                        value="1"></div>
                <div class="col"><input type="text" class="form-control" name="questions[1][answers][2][text]"disabled
                        placeholder="Câu trả lời 3"><input type="radio" name="questions[1][correct_answer]"
                        value="2"></div>
                <div class="col"><input type="text" class="form-control" name="questions[1][answers][3][text]"disabled
                        placeholder="Câu trả lời 4"><input type="radio" name="questions[1][correct_answer]"
                        value="3"></div>
            </div>
        </div>
    </div>

    <!-- Extra Large Modal -->
    <div class="modal fade" id="exLargeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel4">Câu hỏi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameExLarge" class="form-label">Name</label>
                            <input type="text" id="nameExLarge" class="form-control" placeholder="Enter Name">
                        </div>
                    </div>
                    <div class="field-input-land">
                        <div class="row mb-3">
                        </div>
                        <div class="row mb-3">
                            <div class="col"><input type="text" class="form-control" name="questions[1][text]"
                                    placeholder="Nhập câu hỏi"></div>
                            <div class="col"><input type="text" class="form-control"
                                    name="questions[1][answers][0][text]" placeholder="Câu trả lời 1"><input
                                    type="radio" name="questions[1][correct_answer]" value="0"></div>
                            <div class="col"><input type="text" class="form-control"
                                    name="questions[1][answers][1][text]" placeholder="Câu trả lời 2"><input
                                    type="radio" name="questions[1][correct_answer]" value="1"></div>
                            <div class="col"><input type="text" class="form-control"
                                    name="questions[1][answers][2][text]" placeholder="Câu trả lời 3"><input
                                    type="radio" name="questions[1][correct_answer]" value="2"></div>
                            <div class="col"><input type="text" class="form-control"
                                    name="questions[1][answers][3][text]" placeholder="Câu trả lời 4"><input
                                    type="radio" name="questions[1][correct_answer]" value="3"></div>
                            <div class="col-auto"><button class="btn btn-danger" type="button">-</button></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
