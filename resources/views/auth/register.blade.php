@extends('layouts.app')

@section('title', "Registration")

@section('content')
  <form action="{{ route('register') }}" method="POST">
    @csrf
    <div>
      <label for="name">Name</label>
      <input type="text" name="name" value="{{ old('name') }}" id="name" required>
      <x-error field="name"></x-error>
    </div>

    <div>
      <label for="email">E-mail</label>
      <input type="email" name="email" value="{{ old('email') }}" id="email" required>
      <x-error field="email"></x-error>
    </div>

    <div>
      <label for="username">Username</label>
      <input type="text" name="username" value="{{ old('username') }}" id="username" required>
      <x-error field="username"></x-error>
    </div>

    <div>
      <label for="phone_number">Phone number</label>
      <input type="text" name="phone_number" value="{{ old('phone_number') }}" id="phone_number" required>
      <x-error field="phone_number"></x-error>
    </div>

    <div>
      <label for="state">State</label>
      <input type="text" name="state" value="{{ old('state') }}" id="state" required>
      <x-error field="state"></x-error>
    </div>

    <div>
      <label for="city">City</label>
      <input type="text" name="city" value="{{ old('city') }}" id="city" required>
      <x-error field="city"></x-error>
    </div>

    <div>
      <label for="address">Address</label>
      <input type="text" name="address" value="{{ old('address') }}" id="address" required>
      <x-error field="address"></x-error>
    </div>
    
    <div>
      <label for="password">Password</label>
      <input type="password" name="password" id="password" required>
      <x-error field="password"></x-error>
    </div>
    
    <div>
      <label for="password_confirmation">Password confirmation</label>
      <input type="password" name="password_confirmation" id="password_confirmation" required>
    </div>
    
    <div>
      <input type="submit" value="Submit">
    </div>
  </form>
@endsection