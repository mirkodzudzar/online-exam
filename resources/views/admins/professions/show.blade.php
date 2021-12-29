@extends('layouts.admin')

@section('title', $profession->title)

@section('page_title', $profession->title)
    
@section('content')
  <p>{{ $profession->description }}</p>
  <p>{{ $profession->open_date }} - {{ $profession->close_date }}</p>
@endsection