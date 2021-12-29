<div>
  <label for="title" class="form-label">Title</label>
  <input class="form-control" type="text" name="title" value="{{ old('title', optional($profession ?? null)->title) }}" id="title" required>
  <x-error field="title"></x-error>
</div>

<div>
  <label for="description" class="form-label">Description</label>
  <textarea name="description" id="description" cols="30" rows="10" 
    class="form-control" required>{{ old('description', optional($profession ?? null)->description) }}</textarea>
  <x-error field="description"></x-error>
</div>

<div class="col-md-6 mt-3 row">
  <label for="open_date" class="col-sm-2 col-form-label">Open date</label>
  <div class="col-sm-10">
    <input class="form-control" type="date" name="open_date" value="{{ old('open_date', optional($profession ?? null)->open_date) }}" id="open_date" required>
    <x-error field="open_date"></x-error>
  </div>
</div>

<div class="col-md-6 mt-3 row">
  <label for="close_date" class="col-sm-2 col-form-label">Close date</label>
  <div class="col-sm-10">
    <input class="form-control" type="date" name="close_date" value="{{ old('close_date', optional($profession ?? null)->close_date) }}" id="close_date" required>
    <x-error field="close_date"></x-error>
  </div>
</div>