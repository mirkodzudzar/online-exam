@extends('layouts.admin')

@section('title', "Create new admin user")

@section('page_title', "Create new admin user")

@section('content')
  <form action="{{ route('admins.users.store') }}" method="POST" class="row g-3">
    @csrf
    @include('includes._user-form')
    <div>
      <input class="btn btn-primary mt-5" type="submit" value="Create">
    </div>
  </form>
@endsection