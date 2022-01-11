@extends('layouts.admin')

@section('title', 'Expired Professions')
    
@section('content')
  <h1>Expired Professions <x-badge :value="$professions->count()" type="primary"></x-badge></h1>
  @include('includes._admin-profession-table')
@endsection