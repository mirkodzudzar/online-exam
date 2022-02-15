@extends('layouts.user')

@section('title', $profession->title)

@section('page_title', $profession->title)

@section('content')
  <div class="mb-5">
    <h3>{{ $profession->exam->title }}</h3>
    <p>{{ $profession->exam->description }}</p>
    <x-profession-results :value="$candidate_profession"
                          :result="$candidate_exam">
    </x-profession-results>
    <p class="text-success border border-success ps-2">Correct answers</p>
    <p class="text-danger border border-danger ps-2">Wrong answers</p>
    <div class="card-body p-0">
      @foreach ($exam->questions as $question)
        {{--  Questions table fields with answers to loop througt them  --}}
        @php
        $answers = ['answer_a',
                    'answer_b',
                    'answer_c',
                    'answer_d'];
        $candidate_answer = $question->candidates()
                                     ->where('candidate_id', $candidate_profession->candidate->id)
                                     ->first()
                                     ->pivot
                                     ->candidate_answer;
        @endphp
        <div class="card mb-3 {{ $candidate_answer !== $question->answer_correct ? 'bg-danger' : 'bg-success' }}">
          <div class="card-body bg-white">
            <p><b>{{ $loop->iteration }}. {{ $question->text }}</b></p>
            <ol type="a">
              @foreach ($answers as $answer)
                @if ($candidate_answer !== $question->answer_correct)
                  @if ($candidate_answer === $answer)
                    <li class="text-danger border border-danger ps-2">{{ $question->$answer }}</li>
                  @elseif ($question->answer_correct === $answer)
                    <li class="text-success border border-success ps-2">{{ $question->$answer }}</li>
                  @else
                    <li class="ps-2">{{ $question->$answer }}</li>
                  @endif
                @else
                  <li class="ps-2 {{ $question->answer_correct === $answer ? 'text-success border border-success' : '' }}">{{ $question->$answer }}</li>
                @endif
              @endforeach
            </ol>
            @auth
              @if (Auth::user()->is_admin)
                @include('includes._admin-question-options')
              @endif
            @endauth
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endsection