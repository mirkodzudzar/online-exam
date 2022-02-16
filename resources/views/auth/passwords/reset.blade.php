@extends('layouts.user')

@section('title', "Reset password")

@section('page_title', 'Reset password')

@section('content')
  <form action="{{ route('password.update') }}" method="POST">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">

    <div>
      <label for="email" class="form-label">E-mail *</label>
      <input class="form-control" type="email" name="email" value="{{ $email ?? old('email') }}" id="email" required>
      <x-error field="email"></x-error>
    </div>
    
    <div>
      <label for="password" class="form-label">Password</label>
      <input class="form-control" type="password" name="password" id="password" required autofocus>
      <x-error field="password"></x-error>
    </div>
  
    <div>
      <label for="password_confirmation" class="form-label">Password confirmation</label>
      <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" required>
    </div>
    
    <div class="mt-3">
      <input class="btn btn-primary" type="submit" value="Reset password">
    </div>
  </form>
@endsection