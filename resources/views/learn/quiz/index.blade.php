@extends('learn.layout')
@section('content')
    <div class="card p-5">
        <div class="quiz">
            <form class="quiz-form" method="POST" action="{{ route('learn.doQuiz', $quiz->id) }}">
                @csrf
                <div class="quiz-form__quiz">
                    @if ($quiz->questions)
                        @foreach ($quiz->questions as $question)
                            <p class="quiz-form__question">
                                {{ $question->question }}
                            </p>
                            @foreach ($question->answers as $key =>$item)
                                <label class="quiz-form__ans" for="answers[{{ $question->id.$key }}]">
                                    <input id="answers[{{ $question->id.$key }}]" type="radio" name="answers[{{ $question->id }}]" value="{{ $item->id }}" />
                                    <span class="design"></span>
                                    <span class="text">{{ $item->text }}</span>
                                </label>
                            @endforeach
                            
                        @endforeach
                    @endif

                </div>

                <input class="submit" type="submit" value="Submit" />
            </form>
        </div>
    </div>
@endsection
