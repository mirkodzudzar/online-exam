@extends('layouts.admin')

@section('title', $location->name)

@section('page_title', $location->name)
    
@section('content')

  <div class="card">
    
    @include('includes._admin-location-card-header')

    <div class="card-body">
      @if ($candidates->count() > 0)
        <div>
          @include('includes._admin-candidate-table')
        </div>
      @else
        <p>No candidates yet.</p>
      @endif
    </div>
  </div>
@endsection