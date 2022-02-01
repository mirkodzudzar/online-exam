<div class="card-header">
  <ul class="nav nav-tabs card-header-tabs">
    <li class="nav-item">
      <a class="nav-link {{ Route::is('admins.professions.show') ? 'active' : '' }}" href="{{ route('admins.professions.show', ['profession' => $profession->id]) }}">
        Candidates
        <x-badge :value="$profession->candidates->count()" type="primary"></x-badge>
      </a>
    </li>
  </ul>
</div>