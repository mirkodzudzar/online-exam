@extends('layouts.user')

@section('title', 'Expired Professions')

@section('page_title', 'Expired Professions')
    
@section('content')
  <x-profession-card :professions="$professions"></x-profession-card>
@endsection