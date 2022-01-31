@extends('layouts.admin')

@section('title', 'Candidates')

@section('page_title', 'List of all candidates')
    
@section('content')
  <x-search-form placeholder="Search for candidates"
                :item="$candidates"
                :result="$result ?? null">
  </x-search-form>
  @include('includes._admin-candidate-table')
@endsection