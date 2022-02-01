@extends('layouts.admin')

@section('title', "Edit question")

@section('page_title', "Edit question")

@section('content')
  <form action="{{ route('admins.questions.update', ['question' => $question->id]) }}" method="POST" class="row g-3">
    @csrf
    @method('PUT')
    @include('includes._question-form')
    <div>
      <input class="btn btn-primary mt-5" type="submit" value="Edit">
    </div>
  </form>
@endsection