@extends('layouts.user')

@section('title', 'Home page')

@section('page_title', 'List of your professions')
    
@section('content')
  <x-profession-card :professions="$professions"></x-profession-card>
@endsection