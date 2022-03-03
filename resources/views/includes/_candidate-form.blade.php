<div class="col-md-6 form-group">
  <label for="name" class="form-label">Name *</label>
  <input class="form-control" type="text" name="name" value="{{ old('name', optional($candidate->user ?? null)->name) }}" id="name" required>
  <x-error field="name"></x-error>
</div>

<div class="col-md-6 form-group">
  <label for="email" class="form-label">E-mail *</label>
  <input class="form-control" type="email" name="email" value="{{ old('email', optional($candidate->user ?? null)->email) }}" id="email" required>
  <x-error field="email"></x-error>
</div>

<div class="col-md-6 form-group">
  <label for="username" class="form-label">Username *</label>
  <input class="form-control" type="text" name="username" value="{{ old('username', optional($candidate ?? null)->username) }}" id="username" required>
  <x-error field="username"></x-error>
</div>

<div class="col-md-6 form-group">
  <label for="phone_number" class="form-label">Phone number *</label>
  <input class="form-control" type="text" name="phone_number" value="{{ old('phone_number', optional($candidate ?? null)->phone_number) }}" id="phone_number" required>
  <x-error field="phone_number"></x-error>
</div>

@if(Route::is('users.candidates.edit') )
  <div class="col-md-4 form-group">
    <label for="current_password" class="form-label">Current password</label>
    <input class="form-control" type="password" name="current_password" id="current_password">
    <x-error field="current_password"></x-error>
  </div>
  <div class="col-md-4 form-group">
    <label for="password" class="form-label">Password</label>
    <input class="form-control" type="password" name="password" id="password">
    <x-error field="password"></x-error>
  </div>

  <div class="col-md-4 form-group">
    <label for="password_confirmation" class="form-label">Password confirmation</label>
    <input class="form-control" type="password" name="password_confirmation" id="password_confirmation">
  </div>
@elseif(Route::is('register'))
  <div class="col-md-6 form-group">
    <label for="password" class="form-label">Password *</label>
    <input class="form-control" type="password" name="password" id="password" required>
    <x-error field="password"></x-error>
  </div>

  <div class="col-md-6 form-group">
    <label for="password_confirmation" class="form-label">Password confirmation *</label>
    <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" required>
  </div>
@endif

<div class="col-md-4 form-group">
  <label for="state" class="form-label">State *</label>
  <input class="form-control" type="text" name="state" value="{{ old('state', optional($candidate ?? null)->state) }}" id="state" required>
  <x-error field="state"></x-error>
</div>

<div class="col-md-4 form-group">
  <label for="city" class="form-label">City *</label>
  <input class="form-control" type="text" name="city" value="{{ old('city', optional($candidate ?? null)->city) }}" id="city" required>
  <x-error field="city"></x-error>
</div>

<div class="col-md-4 form-group">
  <label for="address" class="form-label">Address *</label>
  <input class="form-control" type="text" name="address" value="{{ old('address', optional($candidate ?? null)->address) }}" id="address" required>
  <x-error field="address"></x-error>
</div>

<div class="form-group">
  <label for="location">Location where you want to look for work</label>
    <select name="location" id="location" class="form-select form-select-sm">
      <option value="" selected>- none -</option>
      @if ($locations->count() > 0)
        @foreach ($locations as $location)
          <option value="{{ $location->id }}"
            @auth
              @if((int)old('location') === $location->id || $location->id === optional(Auth::user()->candidate->location ?? null)->id) selected @endif>{{ $location->name }}
            @else
              @if((int)old('location') === $location->id) selected @endif>{{ $location->name }}
            @endauth
          </option>
        @endforeach
      @endif
    </select>
  <x-error field="location"></x-error>
</div>

<div class="form-group">
  <label for="document">CV document</label>
  <input type="file" class="form-control-file" id="document" name="document">
  <x-error field="document"></x-error>
</div>

<div>
  @if (optional($candidate ?? null)->document)
    <a href="{{ route('users.candidates.documents.destroy', ['candidate' => $candidate->id]) }}"
      class="btn btn-danger d-inline"
      onclick='event.preventDefault(); document.getElementById("remove-cv-form").submit(); return confirm("Are you sure you want to remove your CV document? You can upload new one any time or leave it empty.");'>
    X</a>
    <p class="d-inline">
      <a href="{{ Storage::url($candidate->document->path) }}" target="_blank" class="btn btn-outline-secondary">Existing CV document</a> -
      uploaded {{ $candidate->document->updated_at->diffForHumans() }}.
    </p>
  @endif
</div>

<div class="form-group">
  <label for="profile_image">Profile image</label>
  <input type="file" class="form-control-file" id="profile_image" name="profile_image">
  <x-error field="profile_image"></x-error>
</div>