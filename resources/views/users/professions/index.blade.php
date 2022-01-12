@extends('layouts.user')

@section('title', 'Home page')

@section('page_title', 'List of professions')
    
@section('content')
  @include('includes._profession-card')
  <x-pager :items="$professions"></x-pager>
@endsection