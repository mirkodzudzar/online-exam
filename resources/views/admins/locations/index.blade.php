@extends('layouts.admin')

@section('title', 'Locations')

@section('page_title', 'List of all locations')
    
@section('content')
  @if ($locations->count() > 0)
    <table class="table table-striped">
      <thead class="table-dark">
        <tr>
          <th>Id</th>
          <th>Name</th>
          <th>Candidates</th>
          <th>Professions</th>
          <th>Options</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($locations as $location)
          <tr>
            <th>{{ $location->id }}</th>
            <td><a href="{{ route('admins.locations.candidates', ['location' => $location->id]) }}" class="text-decoration-none">{{ $location->name }}</a></td>
            <td>{{ $location->candidates_count }}</td>
            <td>{{ $location->professions_count }}</td>
            <td>
              @include('includes._admin-location-options')
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @else
    <p>There are no locations!</p>
  @endif
  <x-pager :items="$locations"></x-pager>
@endsection