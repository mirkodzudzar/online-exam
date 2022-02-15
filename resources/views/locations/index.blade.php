@extends('layouts.user')

@section('title', 'Locations')

@section('page_title', 'List of locations')
    
@section('content')
  @if ($locations->count() > 0)
    <div class="card text-center">
      <div class="card-header bg-secondary text-white fs-5">
        <x-geo-icon></x-geo-icon>
        Locations
      </div>
      <ul class="list-group list-group-flush fs-4">
        @foreach ($locations as $location)
          <li class="list-group-item {{ $location->enabled ? '' : 'bg-warning' }}">
            <a href="{{ route('locations.show', ['location' => $location->id]) }}">
              {{ $location->name }}
            </a>
            @if (!$location->enabled) <x-badge value="Disabled" type="danger"></x-badge> @endif
          </li>  
        @endforeach
      </ul>
    </div>
  @else
    <p>There are no locations yet!</p>
  @endif
@endsection