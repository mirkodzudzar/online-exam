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

<div>
    <label for="exam">Exam</label>
    <select name="exam" multiple id="exam" class="form-select form-select-sm">
        @if (Route::is('admins.professions.edit'))
            <option value="">- none -</option>
        @else
            <option value="" {{ is_null(old('exam')) ? 'selected' : '' }}>- none -</option>
        @endif
        @forelse ($exams as $exam)
            <option value="{{ $exam->id }}" 
                {{-- Select profession exam when there is old exam value. --}}
                @if (((int)old('exam') === $exam->id) ||
                    (optional($profession->exam ?? null)->id == $exam->id))) selected @endif
            >{{ $exam->title }}</option>
            {{ print_r((optional($profession->exam ?? null)->id)) }}
        @empty
            <p>There are no exams yet!</p>
        @endforelse
    </select>
    <x-error field="exam"></x-error>
</div>

<div>
  <label for="location">Locations</label>
    <select name="locations[]" multiple id="location" class="form-select form-select-sm">
      @if (Route::is('admins.professions.edit'))
        <option value="" @if ($profession->locations->count() === 0 || (collect(old('locations'))->contains(null))) selected @endif>- none -</option>
      @else
        <option value="" @if ((collect(old('locations'))->contains(null)) || old('locations') === null) selected @endif>- none -</option>
      @endif
      @if ($locations->count() > 0)
        @foreach ($locations as $location)
          <option value="{{ $location->id }}" 
            {{-- Select profession locations when there are old location values. --}}
            @if (collect(old('locations'))->contains($location->id) ||
                // Profession locations will be selected if they existed in Database, 
                // but when we unselect them or chose other options additionaly - profession location values are still present including newly selected ones.
                // TODO Fix this
                (optional($profession->locations ?? null)->contains($location) && !collect(old('locations'))->contains(null))) selected @endif
          >{{ $location->name }}</option>
        @endforeach
      @endif
    </select>
  <x-error field="locations"></x-error>
</div>

<div class="col-md-6 mt-3 row">
  <label for="open_date" class="col-sm-2 col-form-label">Open date</label>
  <div class="col-sm-10">
    <input class="form-control" type="date" name="open_date"
      value="{{ old('open_date', Carbon\Carbon::parse(optional($profession ?? null)->open_date)->format('Y-m-d')) }}"
      id="open_date" required>
    <x-error field="open_date"></x-error>
  </div>
</div>

<div class="col-md-6 mt-3 row">
  <label for="close_date" class="col-sm-2 col-form-label">Close date</label>
  <div class="col-sm-10">
    <input class="form-control" type="date" name="close_date" value="{{ old('close_date', Carbon\Carbon::parse(optional($profession ?? null)->close_date)->format('Y-m-d')) }}" id="close_date" required>
    <x-error field="close_date"></x-error>
  </div>
</div>