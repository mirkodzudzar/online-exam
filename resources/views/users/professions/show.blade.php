@extends('layouts.user')

@section('title', $profession->title)
    
@section('content')
  <h1>{{ $profession->title }}</h1>
  <p>{{ $profession->description }}</p>
  <p>{{ $profession->open_date->format('d.m.Y') }} - {{ $profession->close_date->format('d.m.Y') }}</p>
  <a href="{{ route('users.professions.show', ['profession' => $profession->id]) }}" class="btn btn-primary">Apply</a>
@endsection