<a class="nav-link p-2 text-dark" href="{{ route('users.candidates.professions.index', ['candidate' => Auth::user()->candidate->id]) }}">Your professions</a>
<div class="dropdown">
  <a href="#" class="dropdown-toggle nav-link p-2 text-dark" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">{{ Auth::user()->email }}</a>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
    <li><a class="dropdown-item nav-link p-2 text-dark" href="{{ route('users.candidates.show', ['candidate' => Auth::user()->candidate->id]) }}">Profile</a></li>
    <li><a class="dropdown-item nav-link p-2 text-dark" href="{{ route('logout') }}"
      onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
      Logout
    </a><li>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
    @csrf
    </form>
  </ul>
</div>