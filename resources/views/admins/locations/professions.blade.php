@extends('admins.layouts.location')
    
@section('location_content')
  @if ($professions->count() > 0)
    <div>
      @include('includes._admin-profession-table')
    </div>
  @else
    <p>No professions yet.</p>
  @endif
@endsection