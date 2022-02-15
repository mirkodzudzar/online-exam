@extends('layouts.admin')

@section('title', $exam->title)

@section('page_title', $exam->title)
    
@section('content')

  <p>{{ $exam->description }}</p>

  @include('includes._admin-exam-options')
  
  <div class="card mt-3">
    
    @include('includes._admin-exam-card-header')

    <div class="card-body">
      @yield('exam_content')
    </div>
  </div>
@endsection