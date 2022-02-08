<h5>To finish application for this profession, please answer correctly on questions below:</h5>
<form class="d-inline" action="{{ route('users.candidates.professions.update', [
  'candidate' => $candidate->id,
  'profession' => $profession->id,
]) }}" method="POST">
  @csrf
  @method('PUT')
  @foreach ($exam->questions as $question)
    <div class="card mb-3 p-2 bg-light">
      <b>{{ $loop->iteration }}. {{ $question->text }}</b>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="answers{{ $question->id }}" id="answer_a_{{ $question->id }}" value="answer_a" {{ old("answers$question->id") === "answer_a" ? 'checked' : '' }}>
        <label class="form-check-label" for="answer_a_{{ $question->id }}">{{ $question->answer_a }}</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="answers{{ $question->id }}" id="answer_b_{{ $question->id }}" value="answer_b" {{ old("answers$question->id") === "answer_b" ? 'checked' : '' }}>
        <label class="form-check-label" for="answer_b_{{ $question->id }}">{{ $question->answer_b }}</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="answers{{ $question->id }}" id="answer_c_{{ $question->id }}" value="answer_c" {{ old("answers$question->id") === "answer_c" ? 'checked' : '' }}>
        <label class="form-check-label" for="answer_c_{{ $question->id }}">{{ $question->answer_c }}</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="answers{{ $question->id }}" id="answer_d_{{ $question->id }}" value="answer_d" {{ old("answers$question->id") === "answer_d" ? 'checked' : '' }}>
        <label class="form-check-label" for="answer_d_{{ $question->id }}">{{ $question->answer_d }}</label>
      </div>
      <x-error field="answers{{ $question->id }}"></x-error>
    </div>
  @endforeach
  <input type="submit" value="Finish" class="btn btn-primary" onclick="return confirm('Are you sure you want to finish applying for this profession? You can not improve your results later!')">
</form>