@extends('layouts.admin')

@section('title', 'Destroyed Professions')

@section('page_title', 'Destroyed Professions')
    
@section('content')
  @include('includes._admin-profession-table')
  <x-pager :items="$professions"></x-pager>
@endsection