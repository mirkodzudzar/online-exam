@extends('layouts.user')

@section('title', 'Home page')

@section('page_title', 'List of professions')
    
@section('content')
  <x-profession-card :professions="$professions"></x-profession-card>
@endsection