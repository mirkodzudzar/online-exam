@extends('layouts.user')

@section('title', 'Home page')
    
@section('content')
  <h1>List of all professions</h1>
  @foreach ($professions as $profession)
    <div class="card text-center mb-3">
      <div class="card-body">
        <h5 class="card-title">
          <a href="{{ route('users.professions.show', ['profession' => $profession->id]) }}">
            {{ $profession->title }}
          </a>
        </h5>
        <p class="card-text">{{ $profession->description }}</p>
      </div>
      <div class="card-footer text-muted">
        {{ $profession->open_date->format('d.m.Y') }} - {{ $profession->close_date->format('d.m.Y') }}
      </div>
    </div>
  @endforeach
@endsection