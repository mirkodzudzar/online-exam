@extends('layouts.user')

@section('title', $profession->title)
    
@section('content')
  @include('includes._profession-show')
  @auth
    @if (Auth::user()->is_admin)
      <a href="{{ route('admins.professions.show', ['profession' => $profession->id]) }}" class="btn btn-primary">View</a>
    @endif
  @endauth
@endsection