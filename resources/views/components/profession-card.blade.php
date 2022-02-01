@forelse ($professions as $profession)
  <div class="card mb-3">
    <div class="card-header bg-secondary text-light">
      <i>Posted {{ $profession->created_at->diffForHumans() }}.</i>
    </div>
    <div class="card-body  {{ $profession->isExpired() ? 'bg-warning' : '' }}">
      @if ($profession->trashed())
        <del>
      @endif
      <h5 class="card-title fs-2">
        <a href="{{ route('professions.show', ['profession' => $profession->id]) }}" class="text-decoration-none {{ $profession->trashed() ? 'text-muted' : '' }}">
          {{ $profession->title }}
        </a>
      </h5>
      @if ($profession->trashed())
        </del>
      @endif
      <p class="card-text">{{ Str::limit($profession->description, 250) }}</p>
      
      <x-location :locations="$profession->locations" :icon="true"></x-location>
      
      <p>
        <x-badge :value="$profession->open_date" type="dark"></x-badge>
        <b> - </b>
        <x-badge :value="$profession->close_date" type="danger"></x-badge>
      </p>
      <x-expired-badge :profession="$profession"></x-expired-badge>
    </div>
  </div>
@empty
  <p>There are no professions!</p>
@endforelse