<h5>To finish application for this profession, please answer correctly on questions below:</h5>
<form class="d-inline" action="{{ route('users.candidates.professions.update', [
  'candidate' => Auth::user()->candidate->id,
  'profession' => $profession->id,
]) }}" method="POST">
  @csrf
  @method('PUT')
  @foreach ($profession->exam->questions as $question)
    <div class="card mb-3 p-2 bg-light">
      <b>{{ $loop->iteration }}. {{ $question->question }}</b>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]" id="answer_a_{{ $question->id }}" value="answer_a">
        <label class="form-check-label" for="answer_a_{{ $question->id }}">{{ $question->answer_a }}</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]" id="answer_b_{{ $question->id }}" value="answer_b">
        <label class="form-check-label" for="answer_b_{{ $question->id }}">{{ $question->answer_b }}</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]" id="answer_c_{{ $question->id }}" value="answer_c">
        <label class="form-check-label" for="answer_c_{{ $question->id }}">{{ $question->answer_c }}</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]" id="answer_d_{{ $question->id }}" value="answer_d">
        <label class="form-check-label" for="answer_d_{{ $question->id }}">{{ $question->answer_d }}</label>
      </div>
    </div>
  @endforeach
  <input type="submit" value="Finish" class="btn btn-primary" onclick="return confirm('Are you sure you want to finish applying for this profession? You can not improve your results later!')">
</form>