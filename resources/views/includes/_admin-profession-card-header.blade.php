<div class="card-header">
  <ul class="nav nav-tabs card-header-tabs">
    <li class="nav-item">
      <a class="nav-link {{ Route::is('admins.candidates.professions.results') ? 'active' : '' }}" href="{{ route('admins.candidates.professions.results', ['profession' => $profession->id]) }}">
        Candidates
        <x-badge :value="$profession->candidates_count" type="primary"></x-badge>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ Route::is('admins.professions.show') ? 'active' : '' }}" aria-current="true" href="{{ route('admins.professions.show', ['profession' => $profession->id]) }}">
        Questions
        <x-badge :value="$profession->questions_count" type="primary"></x-badge>
      </a>
    </li>
  </ul>
</div>