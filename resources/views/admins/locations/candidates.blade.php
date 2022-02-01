@extends('admins.layouts.location')
    
@section('location_content')
  @if ($candidates->count() > 0)
    <div>
      @include('includes._admin-candidate-table')
    </div>
  @else
    <p>No candidates yet.</p>
  @endif
@endsection