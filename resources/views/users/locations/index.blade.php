@extends('layouts.user')

@section('title', 'Locations')

@section('page_title', 'List of locations')
    
@section('content')
  <div class="card text-center">
    <div class="card-header bg-secondary text-white fs-5">
      <x-geo-icon></x-geo-icon>
      Locations
    </div>
    <ul class="list-group list-group-flush fs-4">
      @foreach ($locations as $location)
        <li class="list-group-item">{{ $location->name }}</li>  
      @endforeach
    </ul>
  </div>
@endsection