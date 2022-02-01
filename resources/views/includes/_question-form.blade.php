<div>
    <label for="question" class="form-label">Question</label>
    <input class="form-control" type="text" name="question" value="{{ old('question', optional($question ?? null)->question) }}" id="question" required>
    <x-error field="question"></x-error>
  </div>
  <div>
    <label for="exam">Exam</label>
    <select name="exam" id="exam" class="form-select form-select-sm">
      <option selected>- none -</option>
      @if ($exams->count() > 0)
        @foreach ($exams as $exam)
          <option value="{{ $exam->id }}" 
            {{-- $exam_url is optional parameter value if we came form specific exam to create new question --}}
            @if((int)old('exam') === $exam->id || optional($exam_url ?? null)->id ===  $exam->id || $exam->id === optional($question->exam ?? null)->id) selected @endif>{{ $exam->title }}
          </option>
        @endforeach
      @endif
    </select>
    <x-error field="exam"></x-error>
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