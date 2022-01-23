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

    <div class="d-inline">
      <input class="btn btn-primary d-inline" type="submit" value="Edit">
    </div>
    <div class="d-inline mb-3">
      <a href="{{ route('users.candidates.show', ['candidate' => $candidate->id]) }}" class="btn btn-success d-inline">View profile</a>
    </div>
  </form>

  @can('delete', $candidate->document)
    <form action="{{ route('users.candidates.documents.destroy', ['candidate' => $candidate->id]) }}"
      method="POST">
      @csrf
      @method('DELETE')
      <input type="submit" value="Remove CV" class="btn btn-danger" onclick='return confirm("Are you sure you want to remove your CV document? You can upload new one any time or leave it empty.")'>
    </form>
  @endcan
@endsection