@extends('layouts.admin')

@section('title', 'Questions')
    
@section('content')
  <h1>List of all questions <x-badge :value="$questions->count()" type="primary"></x-badge></h1>
  @include('includes._admin-question-table')
@endsection