@extends('layouts.admin')

@section('title', 'Professions')

@section('page_title', 'List of all professions')
    
@section('content')
  @foreach ($professions as $profession)
    <p>
      {{ $profession->title }}
    </p>
  @endforeach
@endsection