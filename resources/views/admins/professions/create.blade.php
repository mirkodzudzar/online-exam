@extends('layouts.admin')

@section('title', "Create new profession")

@section('page_title', 'Create new profession')

@section('content')
  <form action="{{ route('admins.professions.store') }}" method="POST" class="row g-3">
    @csrf
    @include('includes._profession-form')
    <div>
      <input class="btn btn-primary mt-5" type="submit" value="Create">
    </div>
  </form>
@endsection