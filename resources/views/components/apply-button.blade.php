<form action="{{ route('users.candidates.professions.apply', [
  'candidate' => Auth::user()->candidate->id,
  'profession' => $profession->id
  ]) }}" method="POST">
  @csrf
  <input class="btn btn-primary" type="submit" value="Apply">
</form>