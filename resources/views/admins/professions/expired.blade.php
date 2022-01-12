@extends('layouts.admin')

@section('title', 'Expired Professions')

@section('page_title', 'Expired Professions')
    
@section('content')
  @include('includes._admin-profession-table')
  <x-pager :items="$professions"></x-pager>
@endsection