@extends('layouts.admin')

@section('title', $profession->title)
    
@section('content')

  @include('includes._profession-show')

  <div class="card">
    <div class="card-header">
      <ul class="nav nav-tabs card-header-tabs">
        <li class="nav-item">
          <a class="nav-link active" aria-current="true" href="{{ route('admins.professions.show', ['profession' => $profession->id]) }}">Questions</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admins.candidates.professions.results', ['profession' => $profession->id]) }}">Results</a>
        </li>
      </ul>
    </div>
    <div class="card-body">
      <h3>Questions</h3>
      @forelse ($profession->questions as $question)
        <div class="card mb-3">
          <div class="card-body bg-light">
            <b>{{ $question->id }}. {{ $question->question }}</b>
            <ol type="a">
              <li class="{{ $question->answer_correct === 'answer_a' ? 'text-success border border-success' : '' }}">{{ $question->answer_a }}</li>
              <li class="{{ $question->answer_correct === 'answer_b' ? 'text-success border border-success' : '' }}">{{ $question->answer_b }}</li>
              <li class="{{ $question->answer_correct === 'answer_c' ? 'text-success border border-success' : '' }}">{{ $question->answer_c }}</li>
              <li class="{{ $question->answer_correct === 'answer_d' ? 'text-success border border-success' : '' }}">{{ $question->answer_d }}</li>
            </ol>
            <a href="{{ route('admins.questions.edit', ['question' => $question->id]) }}" class="btn btn-success">Edit</a>
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