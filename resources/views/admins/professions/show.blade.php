@extends('layouts.admin')

@section('title', $profession->title)
    
@section('content')

  @include('includes._profession-show')

  <div class="card">

    @include('includes._admin-profession-card-header')
    
    <div class="card-body">
      <h3>Questions</h3>
      @forelse ($profession->questions as $question)
        <div class="card mb-3">
          <div class="card-body bg-light">
            @if ($question->trashed())
              <del>
            @endif
            <p class="{{ $question->trashed() ? 'text-muted' : '' }}"><b>{{ $question->id }}. {{ $question->question }}</b></p>
            @if ($question->trashed())
              </del>
            @endif
            <ol type="a">
              <li class="{{ $question->answer_correct === 'answer_a' ? 'text-success border border-success' : '' }}">{{ $question->answer_a }}</li>
              <li class="{{ $question->answer_correct === 'answer_b' ? 'text-success border border-success' : '' }}">{{ $question->answer_b }}</li>
              <li class="{{ $question->answer_correct === 'answer_c' ? 'text-success border border-success' : '' }}">{{ $question->answer_c }}</li>
              <li class="{{ $question->answer_correct === 'answer_d' ? 'text-success border border-success' : '' }}">{{ $question->answer_d }}</li>
            </ol>
            
            @include('includes._admin-question-options')

          </div>
        </div>
      @empty
        <p>
          No questions yet. 
        </p>
      @endforelse
      <a href="{{ route('admins.questions.create', ['profession' => $profession->id]) }}" class="btn btn-primary mb-3">Create new question</a>
    </div>
  </div>
@endsection