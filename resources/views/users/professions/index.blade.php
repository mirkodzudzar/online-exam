@extends('layouts.user')

@section('title', 'Home page')
    
@section('content')
  <h1>List of professions <x-badge :value="$professions->count()" type="primary"></x-badge></h1>
  @include('includes._profession-card')
@endsection