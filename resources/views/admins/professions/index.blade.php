@extends('layouts.admin')

@section('title', 'Professions')

@section('page_title', 'List of all professions')
    
@section('content')
  <x-admin-profession-table :professions="$professions"></x-admin-profession-table>
@endsection