<div class="card mb-3 {{ $profession->isExpired() ? 'bg-warning' : '' }}">
  <div class="card-body">
    <div class="fs-5">
      @if ($profession->trashed())
        <del>
      @endif
      <p>
        {{--  $title value will be used if it is passed, if not, title of profession will be used instead  --}}
        <a href="{{ $route }}" class="{{ $profession->trashed() ? 'text-muted' : '' }}">{{ $title ?? $profession->title }}</a>
        {{--  Get created_at value, time when candidate has applied for profession  --}}
        {{--  profession, applied {{ $profession->candidates->first()->pivot->created_at->diffForHumans() }}.  --}}
        Status:
        {{--  Displaying badge with current status of candidate_profession  --}}
        <x-badge>
          @slot('value', $profession->candidates->first()->pivot->status)
          @switch($profession->candidates->first()->pivot->status)
            @case('unapplied')
              @slot('type', 'warning')
              @break
            @case('passed')
              @slot('type', 'success')
              @break
            @case('failed')
              @slot('type', 'danger')
              @break
            @default
              @slot('type', 'primary')
              @break
          @endswitch
        </x-badge>
        <x-expired-badge :profession="$profession"></x-expired-badge>
      </p>
      @if ($profession->trashed())
        </del>
      @endif  
    </div>
  </div>
</div>