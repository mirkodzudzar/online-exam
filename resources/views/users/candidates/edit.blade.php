@extends('layouts.user')

@section('title', "Edit - $candidate->username")

@section('page_title', "Edit - $candidate->username")

@section('content')
  <form action="{{ route('users.candidates.update', ['candidate' => $candidate->id]) }}" 
        method="POST" class="row g-3" 
        enctype="multipart/form-data">
    @csrf
    @method('PUT')

    @include('includes._candidate-form')

    <div>
      <input class="btn btn-primary d-inline" type="submit" value="Edit">
      <a href="{{ route('users.candidates.show', ['candidate' => $candidate->id]) }}" class="btn btn-success ms-3">View profile</a>
    </div>
  </form>

  @can('delete', $candidate->document)
    <form action="{{ route('users.candidates.documents.destroy', ['candidate' => $candidate->id]) }}"
          style="display: none"
          method="POST"
          id="remove-cv-form">
      @csrf
      @method('DELETE')
    </form>
  @endcan
@endsection