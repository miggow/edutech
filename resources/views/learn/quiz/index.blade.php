@extends('learn.layout')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" />
@endsection
@section('content')
    <div class="bgquiz">
        @if (isset($quiz->questions))
            <div class="quiz mt-5">
                <form class="quiz-form" method="POST" action="{{ route('learn.doQuiz', $quiz->id) }}">
                    @csrf
                    <div class="quiz-form__quiz">
                        @foreach ($quiz->questions as $question)
                            <div class="bodyquiz">
                                {{-- cauhoi --}}
                                <div class="cauhoi">
                                    <div class="card-body containerquiz position-relative">
                                        <div class="position-absolute top-50 start-50 translate-middle">
                                            {{ $question->question }}
                                        </div>
                                    </div>
                                    <div class="dapan text-center">
                                        <div class=" row">
                                            @foreach ($question->answers as $key => $item)
                                                <div class="col-xl-6">
                                                    <input type="radio" class="btn-check "
                                                        name="answers[{{ $question->id }}]" value="{{ $item->id }}"
                                                        id="answers[{{ $question->id . $key }}]"  required>
                                                    <label class="btn btn-outline-custom  btn-lg w-100 mb-2"
                                                        for="answers[{{ $question->id . $key }}]">{{ $item->text }}</label>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>


                            </div>
                        @endforeach


                    </div>

                    <button class="submit" type="submit">Submit</button>
                </form>
            </div>
        @else
            <h1>Hiện không có bài tập</h1>
        @endif
    </div>
@endsection
