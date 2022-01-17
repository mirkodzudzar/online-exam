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
        <a href="{{ route('users.professions.show', ['profession' => $profession->id]) }}" class="text-decoration-none {{ $profession->trashed() ? 'text-muted' : '' }}">
          {{ $profession->title }}
        </a>
      </h5>
      @if ($profession->trashed())
        </del>
      @endif
      <p class="card-text">{{ Str::limit($profession->description, 250) }}</p>
      
      @if ($profession->locations->count() > 0)
        <p class="fs-5">
          <x-geo-icon></x-geo-icon>
          @foreach ($profession->locations as $location)
            <a href="{{ route('users.locations.show', ['location' => $location->id]) }}" class="text-decoration-none">
              {{ $location->name }}
            </a>
            {{ $loop->last ? '' : "-" }}
          @endforeach
        </p>
      @endif
      
      <p>
        <x-badge :value="$profession->open_date" type="dark"></x-badge>
        <b> - </b>
        <x-badge :value="$profession->close_date" type="danger"></x-badge>
      </p>
      <x-expired-badge :profession="$profession"></x-expired-badge>
    </div>
    {{-- <div class="card-footer">
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
    </div> --}}
  </div>
@empty
  <p>There are no professions!</p>
@endforelse