@extends('layouts.user')

@section('title', $profession->title)

@section('page_title', $profession->title)
    
@section('content')
  <p>{{ $profession->description }}</p>
  <p>{{ $profession->open_date }} - {{ $profession->close_date }}</p>
  @can('unapply', $profession)
    @if (Auth::user()->candidate->professions()->first()->pivot->status === 'applied')
      @include('includes._profession-questions')
    @endif
    @include('includes._unapply-button')
  @elsecan('apply', $profession)
    @include('includes._apply-button')
  @else
    @guest
      <a href="{{ route('login') }}" class="btn btn-primary">Login to apply</a>
    @endguest
  @endcan
@endsection