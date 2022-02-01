@extends('layouts.admin')

@section('title', "Create new location")

@section('page_title', "Create new location")

@section('content')
  <form action="{{ route('admins.locations.store') }}" method="POST" class="row g-3">
    @csrf
    @include('includes._location-form')
    <div>
      <input class="btn btn-primary mt-5" type="submit" value="Create">
    </div>
  </form>
@endsection