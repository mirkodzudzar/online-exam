@extends('layouts.user')

@section('title', $profession->title)
    
@section('content')
  <h1>
    <a href="{{ route('users.professions.show', ['profession' => $profession->id]) }}">{{ $profession->title }}</a>
  </h1>
  <div class="mb-5">
    <p>
      <x-date-badge :date="$profession->open_date" type="dark"></x-date-badge>
      <b> - </b>
      <x-date-badge :date="$profession->close_date" type="danger"></x-date-badge>
    </p>
    @if (count($profession->questions) > 0)
      @can('update', $candidate_profession)
        @include('includes._profession-questions')
      @endcan
    @endif
    @can('unapply', $profession)
      @include('includes._unapply-button')
    @elsecan('apply', $profession)
      @include('includes._apply-button')
    @else
      @include('includes._profession-results')
    @endcan
  </div>
@endsection