@extends('layouts.app')

@section('title', "Registration")

@section('page_title', 'Candidate Registration')

@section('content')
  <form action="{{ route('register') }}" method="POST">
    @csrf
    <div>
      <label for="name" class="form-label">Name</label>
      <input class="form-control" type="text" name="name" value="{{ old('name') }}" id="name" required>
      <x-error field="name"></x-error>
    </div>

    <div>
      <label for="email" class="form-label">E-mail</label>
      <input class="form-control" type="email" name="email" value="{{ old('email') }}" id="email" required>
      <x-error field="email"></x-error>
    </div>

    <div>
      <label for="username" class="form-label">Username</label>
      <input class="form-control" type="text" name="username" value="{{ old('username') }}" id="username" required>
      <x-error field="username"></x-error>
    </div>

    <div>
      <label for="phone_number" class="form-label">Phone number</label>
      <input class="form-control" type="text" name="phone_number" value="{{ old('phone_number') }}" id="phone_number" required>
      <x-error field="phone_number"></x-error>
    </div>

    <div>
      <label for="state" class="form-label">State</label>
      <input class="form-control" type="text" name="state" value="{{ old('state') }}" id="state" required>
      <x-error field="state"></x-error>
    </div>

    <div>
      <label for="city" class="form-label">City</label>
      <input class="form-control" type="text" name="city" value="{{ old('city') }}" id="city" required>
      <x-error field="city"></x-error>
    </div>

    <div>
      <label for="address" class="form-label">Address</label>
      <input class="form-control" type="text" name="address" value="{{ old('address') }}" id="address" required>
      <x-error field="address"></x-error>
    </div>
    
    <div>
      <label for="password" class="form-label">Password</label>
      <input class="form-control" type="password" name="password" id="password" required>
      <x-error field="password"></x-error>
    </div>
    
    <div>
      <label for="password_confirmation" class="form-label">Password confirmation</label>
      <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" required>
    </div>
    
    <div>
      <input class="btn btn-primary mt-5" type="submit" value="Submit">
    </div>
  </form>
@endsection