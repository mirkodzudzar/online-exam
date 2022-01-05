@extends('layouts.admin')

@section('title', "Create new question")

@section('page_title', "Create new question")

@section('content')
  <form action="{{ route('admins.questions.store') }}" method="POST" class="row g-3">
    @csrf
    @include('includes._question-form')
    <div>
      <input class="btn btn-primary mt-5" type="submit" value="Create">
    </div>
  </form>
@endsection