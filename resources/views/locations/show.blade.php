@extends('layouts.user')

@section('title', "Location - $location->name")

@section('page_title', "$location->name")
    
@section('content')
  <p>All professions related to location {{ $location->name }}</p>
  <p><i class="text-muted">Number of users currently visiting this location: </i>{{ $counter }}</p>
  @auth
    @if (Auth::user()->is_admin)
      @include('includes._admin-location-options')
    @endif
  @endauth
  <x-profession-card :professions="$professions"></x-profession-card>
  <x-pager :items="$professions"></x-pager>
@endsection