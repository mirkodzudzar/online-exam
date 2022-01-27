@extends('layouts.user')

@section('title', 'Home page')

@section('page_title', 'List of professions')
    
@section('content')
  <x-search-form placeholder="Search for professions"
                :item="$professions"
                :result="$result ?? null">
  </x-search-form>
  <x-profession-card :professions="$professions"></x-profession-card>
  <x-pager :items="$professions"></x-pager>
@endsection