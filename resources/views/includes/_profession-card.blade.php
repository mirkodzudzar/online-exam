@forelse ($professions as $profession)
  <div class="card text-center mb-3">
    <div class="card-body">
      <h5 class="card-title">
        <a href="{{ route('users.professions.show', ['profession' => $profession->id]) }}">
          {{ $profession->title }}
        </a>
      </h5>
      <p class="card-text">{{ $profession->description }}</p>
      @can('unapply', $profession)
        @include('includes._unapply-button')
      @elsecan('apply', $profession)
        @include('includes._apply-button')
      @else
        @auth
          <a href="{{ route('users.candidates.professions.show', ['candidate' => Auth::user()->candidate->id, 'profession' => $profession->id]) }}" class="btn btn-outline-info">Exam</a>
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