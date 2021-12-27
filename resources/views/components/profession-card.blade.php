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
        <x-unapply-button :profession="$profession"></x-unapply-button>
      @endcan
      @can('apply', $profession)
        <x-apply-button :profession="$profession"></x-apply-button>
      @endcan
    </div>
    <div class="card-footer text-muted">
      {{ $profession->open_date->format('d.m.Y.') }} - {{ $profession->close_date->format('d.m.Y.') }}
    </div>
  </div>
@empty
  <p>There are no professions!</p>
@endforelse