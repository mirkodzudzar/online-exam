<form class="d-inline" action="{{ route('users.candidates.professions.unapply', [
  'candidate' => Auth::user()->candidate->id,
  'profession' => $profession->id
]) }}" method="POST">
  @csrf
  <input type="submit" value="Unapply" class="btn btn-success" onclick='return confirm("Are you sure you want to unapply {{ $profession->title }}? There are no second chance to apply again!")'>
</form>