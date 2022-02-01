@extends('layouts.admin')

@section('title', "Edit location")

@section('page_title', "Edit Location")

@section('content')
  <form action="{{ route('admins.locations.update', ['location' => $location->id]) }}" method="POST" class="row g-3">
    @csrf
    @method('PUT')
    @include('includes._location-form')
    <div>
      <input class="btn btn-primary mt-5" type="submit" value="Edit">
    </div>
  </form>
@endsection