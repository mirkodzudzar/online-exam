@forelse ($professions as $profession)
  <div class="card text-center mb-3">
    <div class="card-body">
      @if ($profession->trashed())
        <del>
      @endif
      <h5 class="card-title">
        <a href="{{ route('users.professions.show', ['profession' => $profession->id]) }}" class="{{ $profession->trashed() ? 'text-muted' : '' }}">
          {{ $profession->title }}
        </a>
      </h5>
      @if ($profession->trashed())
        </del>
      @endif
      <p class="card-text">{{ Str::limit($profession->description, 250) }}</p>
      @can('unapply', $profession)
        @include('includes._unapply-button')
      @elsecan('apply', $profession)
        @include('includes._apply-button')
      @else
        @auth
          @if (!Auth::user()->is_admin)
            <a href="{{ route('users.candidates.professions.show', 
              ['candidate' => Auth::user()->candidate->id, 'profession' => $profession->id]) }}" class="btn btn-outline-info">Exam</a>
          @endif
        @endauth
      @endcan
    </div>
    <div class="card-footer text-muted">
      {{ $profession->open_date }} - {{ $profession->close_date }}
      @include('includes._expired-badge')
    </div>
  </div>
@empty
  <p>There are no professions!</p>
@endforelse