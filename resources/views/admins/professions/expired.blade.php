@extends('layouts.admin')

@section('title', 'Expired Professions')

@section('page_title', 'Expired Professions')
    
@section('content')
  <x-admin-profession-table :professions="$professions"></x-admin-profession-table>
@endsection