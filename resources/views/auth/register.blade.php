@extends('layouts.user')

@section('title', "Registration")

@section('page_title', 'Candidate Registration')

@section('content')
  <form action="{{ route('register') }}" method="POST" class="row g-3">
    @csrf
    @include('includes._candidate-form')
    <div>
      <input class="btn btn-primary mt-5" type="submit" value="Register">
    </div>
  </form>
@endsection