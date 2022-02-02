@extends('admins.layouts.exam')
    
@section('exam_content')
  <a href="{{ route('admins.questions.create', ['exam' => $exam->id]) }}" class="btn btn-primary mb-3">Create new question</a>
  @if ($questions->count() > 0)
    <div class="card-body">
      @forelse ($questions as $question)
        <div class="card mb-3">
          <div class="card-body bg-light">
            @if ($question->trashed())
              <del>
            @endif
            <p class="{{ $question->trashed() ? 'text-muted' : '' }}"><b>{{ $question->id }}. {{ $question->text }}</b></p>
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
    </div>
  @else
    <p>No questions yet.</p>
  @endif
@endsection