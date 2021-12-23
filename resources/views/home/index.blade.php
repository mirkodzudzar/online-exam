@extends('layouts.app')

@section('title', 'Home page')
    
@section('content')
  <h1>List of all professions</h1>
  @foreach ($professions as $profession)
    <p>
      {{ $profession->title }}
    </p>
  @endforeach
@endsection