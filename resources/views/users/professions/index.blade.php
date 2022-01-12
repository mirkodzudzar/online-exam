@extends('layouts.user')

@section('title', 'Home page')
    
@section('content')
  <h1>List of professions</h1>
  @include('includes._profession-card')
  <x-pager :items="$professions"></x-pager>
@endsection