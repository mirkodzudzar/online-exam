@extends('layouts.admin')

@section('title', 'Professions')
    
@section('page_title', 'List of all professions')

@section('content')
  @include('includes._admin-profession-table')
  <x-pager :items="$professions"></x-pager>
@endsection