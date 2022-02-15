@extends('layouts.admin')

@section('title', "Create new exam")

@section('page_title', "Create new exam")

@section('content')
  <form action="{{ route('admins.exams.store') }}" method="POST" class="row g-3">
    @csrf
    @include('includes._exam-form')
    <div>
      <input class="btn btn-primary mt-5" type="submit" value="Create">
    </div>
  </form>
@endsection