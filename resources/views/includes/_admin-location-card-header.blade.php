<div class="card-header">
  <ul class="nav nav-tabs card-header-tabs">
    <li class="nav-item">
      <a class="nav-link {{ Route::is('admins.locations.candidates') ? 'active' : '' }}" href="{{ route('admins.locations.candidates', ['location' => $location]) }}">
        Candidates
        <x-badge :value="$location->candidates->count()" type="primary"></x-badge>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ Route::is('admins.locations.professions') ? 'active' : '' }}" aria-current="true" href="{{ route('admins.locations.professions', ['location' => $location->id]) }}">
        Professions
        <x-badge :value="$location->professions->count()" type="primary"></x-badge>
      </a>
    </li>
  </ul>
</div>