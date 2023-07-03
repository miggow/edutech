@extends('learn.layout')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" />
@endsection
@section('content')
    <div class="bgquiz">
        @if (isset($quiz->questions))
            <div class="quiz mt-5">
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
                                            @php
                                                $answerStatus = '';
                                                if (isset($results->results[$question->id])) {
                                                    if ($results->results[$question->id] == $item->id) {
                                                        $answerStatus = $item->is_correct ? 'btn-outline-success' : 'btn-outline-danger';
                                                    }
                                                }
                                            @endphp
                                            <div class="col-xl-6">
                                                <input type="radio" class="btn-check" name="answers[{{ $question->id }}]" value="{{ $item->id }}" id="answers[{{ $question->id . $key }}}" autocomplete="off" disabled>
                                                <label class="btn btn-lg w-100 mb-2 @if ($answerStatus){{ $answerStatus }}@else{{ 'btn-outline-custom' }}@endif" for="answers[{{ $question->id . $key }}]">{{ $item->text }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
