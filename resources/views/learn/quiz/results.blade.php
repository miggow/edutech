@extends('learn.layout')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" />
@endsection
@section('content')
    <div class="bgquiz">
        @if (isset($quiz->questions))
            <div class="quiz mt-5">
                <div class="quiz-form__quiz">
                    @php
                    // dd($results->results);
                        $arrResults = [];
                        foreach ($results->results as $key => $item) {
                            $arrResults[] = $key;
                        }
                    @endphp
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
                                                @foreach ($results->results as $index => $value)
                                                @php
                                                    dd($item->question_id , $item->id);
                                                @endphp
                                                    @if ($index == $item->question_id && $value == $item->id)
                                                        <input type="radio" class="btn-check text-gray" name="answers[{{ $question->id }}]" value="{{ $item->id }}" id="answers[{{ $question->id . $key }}}"
                                                            autocomplete="off" disabled>
                                                    @else
                                                        <input type="radio" class="btn-check" name="answers[{{ $question->id }}]" value="{{ $item->id }}" id="answers[{{ $question->id . $key }}}"
                                                            autocomplete="off" disabled>
                                                    @endif
                                                @endforeach
                                                <label class="btn btn-outline-custom btn-lg w-100 mb-2" for="answers[{{ $question->id . $key }}]">{{ $item->text }}</label>
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
