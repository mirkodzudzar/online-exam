@extends('layouts.user')

@section('title', 'Home page')

@section('page_title', 'List of professions')
    
@section('content')
  <form action="{{ route('professions.index') }}" method="GET">
    <input type="text" name="profession_search" required/>
    <button type="submit">Search</button>
  </form>
  <x-profession-card :professions="$professions"></x-profession-card>
  <x-pager :items="$professions"></x-pager>
@endsection