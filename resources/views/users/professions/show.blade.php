@extends('layouts.user')

@section('title', $profession->title)
    
@section('content')
  <h1>{{ $profession->title }}</h1>
  <p>{{ $profession->description }}</p>
  <p>{{ $profession->open_date->format('d.m.Y') }} - {{ $profession->close_date->format('d.m.Y') }}</p>
    @can('unapply', $profession)
      <x-unapply-button :profession="$profession"></x-unapply-button>
    @elsecan('apply', $profession)
      <x-apply-button :profession="$profession"></x-apply-button>
    @else
      <a href="{{ route('login') }}" class="btn btn-primary">Login to apply</a>
    @endcan
@endsection