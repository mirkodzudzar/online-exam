@extends('layouts.user')

@section('title', "Login")

@section('page_title', 'Login')

@section('content')
  <form action="{{ route('login') }}" method="POST">
    @csrf

    <div>
      <label for="email" class="form-label">E-mail *</label>
      <input class="form-control" type="email" name="email" value="{{ old('email') }}" id="email" required>
      <x-error field="email"></x-error>
    </div>
    
    <div>
      <label for="password" class="form-label">Password *</label>
      <input class="form-control" type="password" name="password" id="password" required>
      <x-error field="password"></x-error>
    </div>
    
    <div class="mt-3">
      <input class="btn btn-primary" type="submit" value="Login">
      <a href="{{ route('password.request') }}" class="ms-3">Forgot your password?</a>
    </div>
  </form>
@endsection