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
      <input class="btn btn-primary mt-5" type="submit" value="Edit">
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