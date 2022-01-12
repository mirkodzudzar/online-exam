@extends('layouts.admin')

@section('title', 'Questions')

@section('page_title', 'List of all questions')
    
@section('content')
  @include('includes._admin-question-table')
  <x-pager :items="$questions"></x-pager>
@endsection