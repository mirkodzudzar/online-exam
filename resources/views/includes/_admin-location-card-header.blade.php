<div class="card-header">
  <ul class="nav nav-tabs card-header-tabs">
    <li class="nav-item">
      <a class="nav-link {{ Route::is('admins.locations.candidates') ? 'active' : '' }}" href="{{ route('admins.locations.candidates', ['location' => $location]) }}">
        Candidates
        <x-badge :value="$candidates->count()" type="primary"></x-badge>
      </a>
    </li>
    {{-- <li class="nav-item">
      <a class="nav-link {{ Route::is('admins.professions.show') ? 'active' : '' }}" aria-current="true" href="{{ route('admins.professions.show', ['profession' => $profession->id]) }}">
        Professions
        <x-badge :value="$profession->professions_count" type="primary"></x-badge>
      </a>
    </li> --}}
  </ul>
</div>