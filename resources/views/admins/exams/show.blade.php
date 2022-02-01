@extends('layouts.admin')

@section('title', "Exam - {$exam->title}")

@section('page_title', "Exam - {$exam->title}")
    
@section('content')
  <p>{{ $exam->description }}</p>
@endsection