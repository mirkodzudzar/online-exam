@extends('layouts.user')

@section('title', "Password reset")

@section('page_title', 'Password reset')

@section('content')
  <form action="{{ route('password.email') }}" method="POST">
    @csrf

    <div>
      <label for="email" class="form-label">E-mail *</label>
      <input class="form-control" type="email" name="email" value="{{ old('email') }}" id="email">
      <x-error field="email"></x-error>
    </div>
    
    <div class="mt-3">
      <input class="btn btn-primary" type="submit" value="Send password reset link">
    </div>
  </form>
@endsection