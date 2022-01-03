<h4><u>To finish application for this profession, please answer correctly on questions below:</u></h4>
@foreach ($profession->questions as $question)
  {{ $question->question }}
  <ol type="a">
    <li>{{ $question->answer_a }}</li>
    <li>{{ $question->answer_b }}</li>
    <li>{{ $question->answer_c }}</li>
    <li>{{ $question->answer_d }}</li>
  </ol>
@endforeach
<form class="d-inline" action="{{ route('users.candidates.professions.update', [
  'candidate' => Auth::user()->candidate->id,
  'profession' => $profession->id,
]) }}" method="POST">
  @csrf
  @method('PUT')
  <input type="submit" value="Finish" class="btn btn-primary">
</form>