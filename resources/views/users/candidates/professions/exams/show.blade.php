@extends('layouts.user')

@section('title', $exam->title)
    
@section('content')
  <h1>
    <a href="{{ route('professions.show', ['profession' => $profession->id]) }}">{{ $profession->title }}</a>
  </h1>
  <div class="mb-5">

    <x-date-range :profession="$profession"></x-date-range>
    
    <div class="card mb-3 p-2">
      <h3>{{ $exam->title }}</h3>
      <p>{{ $exam->description }}</p>
      @if (count($exam->questions) > 0)
        @include('includes._exam-questions')
      @endif
    </div>
@endsection