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
          <option value="{{ $profession->id }}" 
            {{-- $profession_url is optional parameter value if we came form specific profession to create new question --}}
            @if((int)old('profession') === $profession->id || optional($profession_url ?? null)->id ===  $profession->id || $profession->id === optional($question->profession ?? null)->id) selected @endif>{{ $profession->title }}
          </option>
        @endforeach
      @endif
    </select>
    <x-error field="profession"></x-error>
  </div>

  <div id="answer_correct">Type and check correct answer</div>
  <x-error field="answer_correct"></x-error>

  <div>
    <div class="input-group">
      <div class="input-group-prepend">
        <div class="input-group-text">
        <input type="radio" name="answer_correct" value="answer_a" aria-labelledby="answer_correct"
          @if(old('answer_correct') == "answer_a" || optional($question ?? null)->answer_correct == 'answer_a') checked @endif>
        </div>
      </div>
      <input type="text" class="form-control" name="answer_a" required aria-labelledby="answer_correct" placeholder="Answer A"
        value="{{ old('answer_a', optional($question ?? null)->answer_a) }}">
    </div>
    <x-error field="answer_a"></x-error>
  </div>
  <div>
    <div class="input-group">
      <div class="input-group-prepend">
        <div class="input-group-text">
        <input type="radio" name="answer_correct" value="answer_b" aria-labelledby="answer_correct"
          @if(old('answer_correct') == "answer_b" || optional($question ?? null)->answer_correct == 'answer_b') checked @endif>
        </div>
      </div>
      <input type="text" class="form-control" name="answer_b" required aria-labelledby="answer_correct" placeholder="Answer B"
        value="{{ old('answer_b', optional($question ?? null)->answer_b) }}">
    </div>
    <x-error field="answer_b"></x-error>
  </div>
  <div>
    <div class="input-group">
      <div class="input-group-prepend">
        <div class="input-group-text">
        <input type="radio" name="answer_correct" value="answer_c" aria-labelledby="answer_correct"
          @if(old('answer_correct') == "answer_c" || optional($question ?? null)->answer_correct == 'answer_c') checked @endif>
        </div>
      </div>
      <input type="text" class="form-control" name="answer_c" required aria-labelledby="answer_correct" placeholder="Answer C"
        value="{{ old('answer_c', optional($question ?? null)->answer_c) }}">
    </div>
    <x-error field="answer_c"></x-error>
  </div>
  <div>
    <div class="input-group">
      <div class="input-group-prepend">
        <div class="input-group-text">
        <input type="radio" name="answer_correct" value="answer_d" aria-labelledby="answer_correct"
          @if(old('answer_correct') == "answer_d" || optional($question ?? null)->answer_correct == 'answer_d') checked @endif>
        </div>
      </div>
      <input type="text" class="form-control" name="answer_d" required aria-labelledby="answer_correct" placeholder="Answer D"
        value="{{ old('answer_d', optional($question ?? null)->answer_d) }}">
    </div>
    <x-error field="answer_d"></x-error>
  </div>