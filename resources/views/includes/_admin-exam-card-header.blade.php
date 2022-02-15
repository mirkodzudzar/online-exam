<div class="card-header">
  <ul class="nav nav-tabs card-header-tabs">
    <li class="nav-item">
      <a class="nav-link {{ Route::is('admins.exams.professions') ? 'active' : '' }}" href="{{ route('admins.exams.professions', ['exam' => $exam]) }}">
        Professions
        <x-badge :value="$exam->professions->count()" type="primary"></x-badge>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ Route::is('admins.exams.questions') ? 'active' : '' }}" aria-current="true" href="{{ route('admins.exams.questions', ['exam' => $exam]) }}">
        Questions
        <x-badge :value="$exam->questions->count()" type="primary"></x-badge>
      </a>
    </li>
  </ul>
</div>