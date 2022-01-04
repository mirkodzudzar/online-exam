@extends('layouts.user')

@section('title', $profession->title)

@section('page_title', $profession->title)
    
@section('content')
  <p>{{ $profession->description }}</p>
  <p>{{ $profession->open_date }} - {{ $profession->close_date }}</p>
  @can('unapply', $profession)
    <a href="{{ route('users.candidates.professions.show', ['candidate' => Auth::user()->candidate->id, 'profession' => $profession->id]) }}" class="btn btn-outline-info">Exam</a>
    @include('includes._unapply-button')
  @elsecan('apply', $profession)
    @include('includes._apply-button')
  @else
    @guest
      <a href="{{ route('login') }}" class="btn btn-primary">Login to apply</a>
    @else
      @if (!Auth::user()->is_admin)
        <a href="{{ route('users.candidates.professions.show', ['candidate' => Auth::user()->candidate->id, 'profession' => $profession->id]) }}" class="btn btn-outline-info">Exam</a>
      @endif
    @endguest
  @endcan
@endsection