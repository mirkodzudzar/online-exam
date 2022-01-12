@extends('layouts.user')

@section('title', 'Home page')
    
@section('content')
  <h1>List of your professions</h1>
  @include('includes._profession-card')
  <x-pager :items="$professions"></x-pager>
@endsection