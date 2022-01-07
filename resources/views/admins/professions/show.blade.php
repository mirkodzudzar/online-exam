@extends('layouts.admin')

@section('title', $profession->title)
    
@section('content')
  <p class="text-muted"><i>Posted {{ $profession->created_at->diffForHumans() }}.</i></p>

  @if ($profession->trashed())
    <del>
  @endif
  <h1 class="card-title {{ $profession->trashed() ? 'text-muted' : '' }}">{{ $profession->title }}</h1>
  <div class="mb-3">
    @include('includes._expired-badge')
  </div>
  @if ($profession->trashed())
    </del>
  @endif
  <p>{{ $profession->description }}</p>
  <p>
    <x-badge :value="$profession->open_date" type="dark"></x-badge>
    <b> - </b>
    <x-badge :value="$profession->close_date" type="danger"></x-badge>
  </p>

  <h3>Questions</h3>
  @forelse ($profession->questions as $question)
    <div class="card mb-3 p-2">
      <b>{{ $loop->iteration }}. {{ $question->question }}</b>
      <ol type="a">
        <li class="{{ $question->answer_correct === 'answer_a' ? 'text-success border border-success' : '' }}">{{ $question->answer_a }}</li>
        <li class="{{ $question->answer_correct === 'answer_b' ? 'text-success border border-success' : '' }}">{{ $question->answer_b }}</li>
        <li class="{{ $question->answer_correct === 'answer_c' ? 'text-success border border-success' : '' }}">{{ $question->answer_c }}</li>
        <li class="{{ $question->answer_correct === 'answer_d' ? 'text-success border border-success' : '' }}">{{ $question->answer_d }}</li>
      </ol>
    </div>
  @empty
    <p>
      No questions yet. 
    </p>
  @endforelse
  <a href="{{ route('admins.questions.create', ['profession' => $profession->id]) }}" class="btn btn-primary mb-3">Create new question</a>
@endsection