@extends('layouts.user')

@section('title', "Profile of $candidate->username")

@section('page_title', "Profile of - $candidate->username")

@section('content')
  @include('includes._candidate-show')

  <a href="{{ route('users.candidates.edit', ['candidate' => $candidate->id]) }}" class="btn btn-primary">Edit profile</a>
@endsection