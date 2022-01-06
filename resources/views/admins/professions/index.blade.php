@extends('layouts.admin')

@section('title', 'Professions')
    
@section('content')
  <h1>List of all professions <x-badge :value="$professions_count" type="primary"></x-badge></h1>
  @include('includes._admin-profession-table')
@endsection