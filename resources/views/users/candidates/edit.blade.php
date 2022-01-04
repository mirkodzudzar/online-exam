@extends('layouts.user')

@section('title', "Edit - $candidate->username")

@section('page_title', "Edit - $candidate->username")

@section('content')
  <form action="{{ route('users.candidates.update', ['candidate' => $candidate->id]) }}" method="POST" class="row g-3">
    @csrf
    @method('PUT')
    
    @include('includes._candidate-form')

    <div>
      <input class="btn btn-primary mt-5" type="submit" value="Edit">
    </div>
  </form>
@endsection