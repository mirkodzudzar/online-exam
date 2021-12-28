<a class="nav-link p-2 text-dark" href="{{ route('home.index') }}">Home</a>
<a class="nav-link p-2 text-dark" href="{{ route('admins.professions.index') }}">Admin panel</a>
<a class="nav-link p-2 text-dark" href="{{ route('logout') }}"
  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
  Logout ADMIN
</a>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
  @csrf
</form>
