@extends('layouts.user')

@section('title', "Location - $location->name")

@section('page_title', "$location->name")
    
@section('content')
  <p>All professions related to location {{ $location->name }}</p>
  <x-profession-card :professions="$professions"></x-profession-card>
  <x-pager :items="$professions"></x-pager>
@endsection