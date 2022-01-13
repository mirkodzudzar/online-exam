<style>
  body {
    font-family: Arial, Helvetica, sans-serif;
  }
</style>

<p>Hi {{ $candidate->username }}.</p>

<p>
  You have successfully applied for the profession '{{ $profession->title }}'.
  <a href="{{ route('users.professions.show', ['profession' => $profession->id]) }}">Visit</a>
  it now.
</p>

@if ($profession->questions->count() > 0)
  <p>You could now complete the exam for this profession to have a better chance of success.</p>
  <p>Please <a href="{{ route('users.candidates.professions.show', [
    'candidate' => $candidate->id,
    'profession' => $profession->id,
  ]) }}">visit the profession</a>  again and try to give the best answers to the questions. Good luck!</p>
@endif

<p>If you would like to 
  <a href="{{ route('users.professions.show', ['profession' => $profession->id]) }}">unapply</a>, 
  you can do so at any time until the profession expires.
</p>

<p>Deadline: {{ $profession->open_date }} - {{ $profession->close_date }}</p>