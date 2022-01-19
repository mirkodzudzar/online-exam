@extends('layouts.admin')

@section('title', $location->name)

@section('page_title', $location->name)
    
@section('content')

  <div class="card">
    
    @include('includes._admin-location-card-header')

    <div class="card-body">
      @yield('location_content')
    </div>
  </div>
@endsection