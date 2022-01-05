  <div>
    <label for="question" class="form-label">Question</label>
    <input class="form-control" type="text" name="question" value="{{ old('question', optional($question ?? null)->question) }}" id="question" required>
    <x-error field="question"></x-error>
  </div>
  <div>
    <label for="profession">Profession</label>
    <select name="profession" id="profession" class="form-select form-select-sm">
      <option selected></option>
      @if ($professions->count() > 1)
        @foreach ($professions as $profession)
          <option value="{{ $profession->title }}" 
            @if(old('profession') == $profession->title || $profession->title == optional($question->profession ?? null)->title) selected @endif>{{ $profession->title }}
          </option>
        @endforeach
      @endif
    </select>
    <x-error field="profession"></x-error>
  </div>
  <div class="row g-3">
    <div class="col-md-3">
      <input class="form-check-input ml-2 position-relative" type="radio" name="answer_correct" id="answer_a" value="answer_a"
        @if(old('answer_correct') == "answer_a" || optional($question ?? null)->answer_correct == 'answer_a') checked @endif>
      <x-error field="answer_correct"></x-error>
      <label for="answer_a" class="form-label">Answer A</label>
      <input class="form-control" type="text" name="answer_a" value="{{ old('answer_a', optional($question ?? null)->answer_a) }}" id="answer_a" required>
      <x-error field="answer_a"></x-error>
    </div>

    <div class="col-md-3">
      <input class="form-check-input ml-2 position-relative" type="radio" name="answer_correct" id="answer_b" value="answer_b"
        @if(old('answer_correct') == "answer_b" || optional($question ?? null)->answer_correct == 'answer_b') checked @endif>
      <x-error field="answer_correct"></x-error>
      <label for="answer_b" class="form-label">Answer B</label>
      <input class="form-control" type="text" name="answer_b" value="{{ old('answer_b', optional($question ?? null)->answer_b) }}" id="answer_b" required>
      <x-error field="answer_b"></x-error>
    </div>

    <div class="col-md-3">
      <input class="form-check-input ml-2 position-relative" type="radio" name="answer_correct" id="answer_c" value="answer_c"
        @if(old('answer_correct') == "answer_c" || optional($question ?? null)->answer_correct == 'answer_c') checked @endif>
      <x-error field="answer_correct"></x-error>
      <label for="answer_c" class="form-label">Answer C</label>
      <input class="form-control" type="text" name="answer_c" value="{{ old('answer_c', optional($question ?? null)->answer_c) }}" id="answer_c" required>
      <x-error field="answer_c"></x-error>
    </div>

    <div class="col-md-3">
      <input class="form-check-input ml-2 position-relative" type="radio" name="answer_correct" id="answer_d" value="answer_d"
        @if(old('answer_correct') == "answer_d" || optional($question ?? null)->answer_correct == 'answer_d') checked @endif>
      <x-error field="answer_correct"></x-error>
      <label for="answer_d" class="form-label">Answer D</label>
      <input class="form-control" type="text" name="answer_d" value="{{ old('answer_d', optional($question ?? null)->answer_d) }}" id="answer_d" required>
      <x-error field="answer_d"></x-error>
    </div>
  </div>
  
  