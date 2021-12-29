@extends('layouts.admin')

@section('title', "Edit - $profession->title")

@section('page_title', "Edit - $profession->title")

@section('content')
  <form action="{{ route('admins.professions.update', ['profession' => $profession->id]) }}" method="POST" class="row g-3">
    @csrf
    @method('PUT')
    @include('includes._profession-form')
    <div>
      <input class="btn btn-primary mt-5" type="submit" value="Edit">
    </div>
  </form>
@endsection