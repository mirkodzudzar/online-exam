@extends('layouts.user')

@section('title', $profession->title)
    
@section('content')
  @include('includes._profession-show')
@endsection