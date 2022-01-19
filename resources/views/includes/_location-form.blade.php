<div>
  <label for="name" class="form-label">Name *</label>
  <input class="form-control" type="text" name="name" value="{{ old('name', optional($location ?? null)->name) }}" id="name" required>
  <x-error field="name"></x-error>
</div>