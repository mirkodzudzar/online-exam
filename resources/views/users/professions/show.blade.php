@extends('layouts.user')

@section('title', $profession->title)

@section('page_title', $profession->title)
    
@section('content')
  <p>{{ $profession->description }}</p>
  <p>{{ $profession->open_date }} - {{ $profession->close_date }}</p>
    @can('unapply', $profession)
      <x-unapply-button :profession="$profession"></x-unapply-button>
    @elsecan('apply', $profession)
      <x-apply-button :profession="$profession"></x-apply-button>
    @else
      @guest
        <a href="{{ route('login') }}" class="btn btn-primary">Login to apply</a>
      @endguest
    @endcan
@endsection