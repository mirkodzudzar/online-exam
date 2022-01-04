@extends('layouts.user')

@section('title', $profession->title)

@section('page_title', $profession->title)
    
@section('content')
  <p>{{ $profession->description }}</p>
  <p>{{ $profession->open_date }} - {{ $profession->close_date }}</p>
  @if (count($profession->questions) > 0)
    @can('update', $candidate_profession)
      @include('includes._profession-questions')
    @endcan
  @endif
  @can('unapply', $profession)
    @include('includes._unapply-button')
  @elsecan('apply', $profession)
    @include('includes._apply-button')
  @else
    @include('includes._profession-results')
  @endcan
@endsection