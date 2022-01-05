@extends('layouts.admin')

@section('title', 'Destroyed Professions')
    
@section('content')
  <h1>Destroyed Professions <x-badge :value="$professions_destroyed_count" type="primary"></x-badge></h1>
  @include('includes._admin-profession-table')
@endsection