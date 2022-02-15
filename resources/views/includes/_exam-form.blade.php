<div>
  <label for="title" class="form-label">Title *</label>
  <input class="form-control" type="text" name="title" value="{{ old('title', optional($exam ?? null)->title) }}" id="title" required>
  <x-error field="title"></x-error>
</div>

<div>
  <label for="description" class="form-label">Description</label>
  <textarea name="description" id="description" cols="30" rows="10" class="form-control" required>
    {{ old('description', optional($exam ?? null)->description) }}
  </textarea>
  <x-error field="description"></x-error>
</div>