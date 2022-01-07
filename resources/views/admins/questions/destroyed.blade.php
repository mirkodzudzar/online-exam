@extends('layouts.admin')

@section('title', 'Questions')
    
@section('content')
  <h1>List of destroyed questions <x-badge :value="$questions_destroyed_count" type="primary"></x-badge></h1>
  @include('includes._admin-question-table')
@endsection