@extends('layouts.admin')

@section('title', 'Professions')
    
@section('page_title', 'List of all professions')

@section('content')
  <x-search-form placeholder="Search for professions"
                :item="$professions"
                :result="$result ?? null">
  </x-search-form>
  @include('includes._admin-profession-table')
@endsection