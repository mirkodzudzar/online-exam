@extends('layouts.user')

@section('title', 'Home page')
    
@section('content')
  <h1>List of your professions</h1>
  @forelse ($professions as $profession)
    <p>
      {{ $profession->title }}
    </p>
  @empty
    <p>You do not have list of professions yet!</p>
  @endforelse
@endsection