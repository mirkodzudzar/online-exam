@extends('layouts.user')

@section('title', $profession->title)
    
@section('content')
  <h1>
    <a href="{{ route('users.professions.show', ['profession' => $profession->id]) }}" class="text-decoration-none">{{ $profession->title }}</a>
  </h1>
  <div class="mb-5">
    <p>
      <x-badge :value="$profession->open_date" type="dark"></x-badge>
      <b> - </b>
      <x-badge :value="$profession->close_date" type="danger"></x-badge>
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
    @endcan
    @if ($candidate_profession->status !== 'applied')
      <x-profession-results :value="$candidate_profession"></x-profession-results>
    @endif
  </div>
@endsection