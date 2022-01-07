@extends('layouts.user')

@section('title', $profession->title)
    
@section('content')
  <p class="text-muted"><i>Posted {{ $profession->created_at->diffForHumans() }}.</i></p>

  @if ($profession->trashed())
    <del>
  @endif
  <h1 class="card-title {{ $profession->trashed() ? 'text-muted' : '' }}">{{ $profession->title }}</h1>
  @if ($profession->trashed())
    </del>
  @endif
  <p>{{ $profession->description }}</p>
  <p>
    <x-badge :value="$profession->open_date" type="dark"></x-badge>
    <b> - </b>
    <x-badge :value="$profession->close_date" type="danger"></x-badge>
  </p>
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
        <a href="{{ route('users.candidates.professions.show', ['candidate' => Auth::user()->candidate->id, 'profession' => $profession->id]) }}" class="btn btn-outline-info">Result</a>
      @endif
    @endguest
  @endcan
@endsection