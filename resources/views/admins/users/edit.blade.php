@extends('layouts.admin')

@section('title', "Edit - $user->name")

@section('page_title', "Edit - $user->name")

@section('content')
  <form action="{{ route('admins.users.update', ['user' => $user->id]) }}" method="POST" class="row g-3">
    @csrf
    @method('PUT')
    @include('includes._user-form')
    <div>
      <input class="btn btn-primary mt-5" type="submit" value="Edit">
    </div>
  </form>
@endsection