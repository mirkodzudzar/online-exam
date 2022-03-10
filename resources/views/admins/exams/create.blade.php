@extends('layouts.admin')

@section('title', "Create new exam")

@section('page_title', "Create new exam")

@section('content')
  <form action="{{ route('admins.exams.store') }}" method="POST">
    @csrf
    <div class="w-auto px-2">
      @livewire('questions')
    </div>
    <div>
      <input class="btn btn-primary mt-5" type="submit" value="Create">
    </div>
  </form>
@endsection