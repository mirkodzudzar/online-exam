@extends('layouts.admin')

@section('title', 'Questions')

@section('page_title', 'List of all questions')
    
@section('content')
  <x-search-form placeholder="Search for questions"
                :item="$questions"
                :result="$result ?? null">
  </x-search-form>
  @include('includes._admin-question-table')
  <x-pager :items="$questions"></x-pager>
@endsection