@extends('layouts.user')

@section('title', 'Home page')
    
@section('content')
  <h1>List of your professions</h1>
  <x-profession-card :professions="$professions"></x-profession-card>
@endsection