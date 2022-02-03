@extends('layouts.user')

@section('title', $profession->title)
    
@section('content')
  <h1>
    <a href="{{ route('professions.show', ['profession' => $profession->id]) }}">{{ $profession->title }}</a>
  </h1>
  <div class="mb-5">

    <x-date-range :profession="$profession"></x-date-range>
    
    <div class="card mb-3 p-2">
      <h3>{{ $profession->exam->title }}</h3>
      <p>{{ $profession->exam->description }}</p>
      @if (count($profession->exam->questions) > 0)
      @can('update', $candidate_profession)
        @include('includes._profession-questions')
      @endcan
    @endif
    </div>
    @can('unapply', $profession)
      @include('includes._unapply-button')
    @elsecan('apply', $profession)
      @include('includes._apply-button')
    @endcan
    @if ($candidate_profession->status !== 'applied')
      <x-profession-results :value="$candidate_profession"></x-profession-results>
    @endif
  </div>
@endsection