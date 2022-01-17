<div class="col-md-6">
  <label for="name" class="form-label">Name *</label>
  <input class="form-control" type="text" name="name" value="{{ old('name', optional($user ?? null)->name) }}" id="name" required>
  <x-error field="name"></x-error>
</div>

<div class="col-md-6">
  <label for="email" class="form-label">E-mail *</label>
  <input class="form-control" type="email" name="email" value="{{ old('email', optional($user ?? null)->email) }}" id="email" required>
  <x-error field="email"></x-error>
</div>

@if (Route::is('admins.users.create'))
  <div class="col-md-6">
    <label for="password" class="form-label">Password *</label>
    <input class="form-control" type="password" name="password" id="password" required>
    <x-error field="password"></x-error>
  </div>

  <div class="col-md-6">
    <label for="password_confirmation" class="form-label">Password confirmation *</label>
    <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" required>
  </div>
@elseif (Route::is('admins.users.edit'))
  <div class="col-md-4">
    <label for="current_password" class="form-label">Current password *</label>
    <input class="form-control" type="password" name="current_password" id="current_password" required>
    <x-error field="current_password"></x-error>
  </div>
  <div class="col-md-4">
    <label for="password" class="form-label">Password *</label>
    <input class="form-control" type="password" name="password" id="password" required>
    <x-error field="password"></x-error>
  </div>

  <div class="col-md-4">
    <label for="password_confirmation" class="form-label">Password confirmation *</label>
    <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" required>
  </div>
@endif