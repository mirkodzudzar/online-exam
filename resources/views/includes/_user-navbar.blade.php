<a class="nav-link p-2 text-dark" href="{{ route('users.professions.index') }}">Home</a>
<a class="nav-link p-2 text-dark" href="{{ route('users.candidates.professions.index', ['candidate' => Auth::user()->candidate->id]) }}">Professions</a>
<a class="nav-link p-2 text-dark" href="{{ route('logout') }}"
  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
  Logout ({{ Auth::user()->candidate->username }})
</a>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
@csrf
</form>