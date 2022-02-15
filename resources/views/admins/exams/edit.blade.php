@extends('layouts.admin')

@section('title', "Edit exam")

@section('page_title', "Edit exam")

@section('content')
  <form action="{{ route('admins.exams.update', ['exam' => $exam->id]) }}" method="POST" class="row g-3">
    @csrf
    @method('PUT')
    @include('includes._exam-form')
    <div>
      <input class="btn btn-primary mt-5" type="submit" value="Edit">
    </div>
  </form>
@endsection