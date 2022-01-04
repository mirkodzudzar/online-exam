<div class="col-md-6">
  <label for="name" class="form-label">Name</label>
  <input class="form-control" type="text" name="name" value="{{ old('name', optional($candidate->user ?? null)->name) }}" id="name" required>
  <x-error field="name"></x-error>
</div>

<div class="col-md-6">
  <label for="email" class="form-label">E-mail</label>
  <input class="form-control" type="email" name="email" value="{{ old('email', optional($candidate->user ?? null)->email) }}" id="email" required>
  <x-error field="email"></x-error>
</div>

<div class="col-md-6">
  <label for="username" class="form-label">Username</label>
  <input class="form-control" type="text" name="username" value="{{ old('username', optional($candidate ?? null)->username) }}" id="username" required>
  <x-error field="username"></x-error>
</div>

<div class="col-md-6">
  <label for="phone_number" class="form-label">Phone number</label>
  <input class="form-control" type="text" name="phone_number" value="{{ old('phone_number', optional($candidate ?? null)->phone_number) }}" id="phone_number" required>
  <x-error field="phone_number"></x-error>
</div>

@if(Route::is('users.candidates.edit') )
  <div class="col-md-4">
    <label for="current_password" class="form-label">Current password</label>
    <input class="form-control" type="password" name="current_password" id="current_password" required>
    <x-error field="current_password"></x-error>
  </div>
  <div class="col-md-4">
    <label for="password" class="form-label">Password</label>
    <input class="form-control" type="password" name="password" id="password" required>
    <x-error field="password"></x-error>
  </div>

  <div class="col-md-4">
    <label for="password_confirmation" class="form-label">Password confirmation</label>
    <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" required>
  </div>
@elseif(Route::is('register'))
  <div class="col-md-6">
    <label for="password" class="form-label">Password</label>
    <input class="form-control" type="password" name="password" id="password" required>
    <x-error field="password"></x-error>
  </div>

  <div class="col-md-6">
    <label for="password_confirmation" class="form-label">Password confirmation</label>
    <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" required>
  </div>
@endif

<div class="col-md-4">
  <label for="state" class="form-label">State</label>
  <input class="form-control" type="text" name="state" value="{{ old('state', optional($candidate ?? null)->state) }}" id="state" required>
  <x-error field="state"></x-error>
</div>

<div class="col-md-4">
  <label for="city" class="form-label">City</label>
  <input class="form-control" type="text" name="city" value="{{ old('city', optional($candidate ?? null)->city) }}" id="city" required>
  <x-error field="city"></x-error>
</div>

<div class="col-md-4">
  <label for="address" class="form-label">Address</label>
  <input class="form-control" type="text" name="address" value="{{ old('address', optional($candidate ?? null)->address) }}" id="address" required>
  <x-error field="address"></x-error>
</div>