@extends('layouts.admin')

@section('title', $profession->title)

@section('page_title', $profession->title)
    
@section('content')
  <p>{{ $profession->description }}</p>
  <p>{{ $profession->open_date->format('m/d/Y') }} - {{ $profession->close_date->format('m/d/Y') }}</p>
@endsection