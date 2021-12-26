@extends('layouts.user')

@section('title', $profession->title)
    
@section('content')
  <h1>{{ $profession->title }}</h1>
  <p>{{ $profession->description }}</p>
  <p>{{ $profession->open_date->format('d.m.Y') }} - {{ $profession->close_date->format('d.m.Y') }}</p>
  <form action="{{ route('users.candidates.professions.store', [
    'candidate' => Auth::user()->candidate->id,
    // this is additional parameter, not sure is this the right way to do it
    'profession' => $profession->id
    ]) }}" method="POST">
    @csrf
    <input class="btn btn-primary" type="submit" value="Apply">
  </form>
@endsection