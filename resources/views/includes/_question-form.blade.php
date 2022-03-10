<div>
  <label for="text" class="form-label">Text</label>
  <input class="form-control" type="text" name="text" value="{{ old('text', optional($question ?? null)->text) }}" id="text" required>
  <x-error field="text"></x-error>
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

@foreach (['A' => 'answer_a', 'B' => 'answer_b', 'C' => 'answer_c', 'D' => 'answer_d'] as $key => $answer)
  <div>
    <div class="input-group">
      <div class="input-group-prepend">
        <div class="input-group-text">
        <input type="radio" name="answer_correct" value="{{ $answer }}" aria-labelledby="answer_correct"
          @if(old('answer_correct') == $answer || optional($question ?? null)->answer_correct == $answer) checked @endif>
        </div>
      </div>
      <input type="text" class="form-control" name="{{ $answer }}" required aria-labelledby="answer_correct" placeholder="Answer {{ $key }}"
        value="{{ old($answer, optional($question ?? null)->$answer) }}">
    </div>
    <x-error field="{{ $answer }}"></x-error>
  </div>
@endforeach