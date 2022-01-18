@extends('layouts.admin')

@section('title', 'Candidates')

@section('page_title', 'List of all candidates')
    
@section('content')
  @include('includes._admin-candidate-table')
@endsection