@extends('layouts.user')

@section('title', $profession->title)

@section('page_title', $profession->title)

@section('content')
  <div class="mb-5">
    @if (count($profession->exam->questions) > 0)
      @can('update', $candidate_profession)
        @include('includes._profession-questions')
      @endcan
    @endif
    @can('unapply', $profession)
      @include('includes._unapply-button')
    @elsecan('apply', $profession)
      @include('includes._apply-button')
    @endcan
    @if ($candidate_profession->status !== 'applied')
      <x-profession-results :value="$candidate_profession"></x-profession-results>
      <div class="card-body">
        @foreach ($profession->exam->questions as $question)
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
          <div class="card mb-3 {{ $candidate_answer !== $question->answer_correct ? 'bg-danger bg-gradient' : 'bg-success' }}">
            <div class="card-body bg-white">
              <p><b>{{ $loop->iteration }}. {{ $question->text }}</b></p>
              <ol type="a">
                @foreach ($answers as $answer)
                  @if ($candidate_answer !== $question->answer_correct)
                    @if ($candidate_answer === $answer)
                      <li class="text-danger border border-danger">{{ $question->$answer }}</li>
                    @elseif ($question->answer_correct === $answer)
                      <li class="text-success border border-success">{{ $question->$answer }}</li>
                    @else
                      <li>{{ $question->$answer }}</li>
                    @endif
                  @else
                    <li class="{{ $question->answer_correct === $answer ? 'text-success border border-success' : '' }}">{{ $question->$answer }}</li>
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
    @endif
  </div>
@endsection