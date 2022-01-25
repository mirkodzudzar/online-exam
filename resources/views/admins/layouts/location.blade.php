@extends('layouts.admin')

@section('title', $location->name)

@section('page_title', $location->name)
    
@section('content')

  @include('includes._admin-location-options')
  
  <div class="card mt-3">
    
    @include('includes._admin-location-card-header')

    <div class="card-body">
      @yield('location_content')
    </div>
  </div>
@endsection