<form class="d-inline" action="{{ route('users.candidates.professions.unapply', [
  'candidate' => Auth::user()->candidate->id,
  'profession' => $profession->id
]) }}" method="POST">
  @csrf
  <input type="submit" value="Unapply" class="btn btn-success">
</form>