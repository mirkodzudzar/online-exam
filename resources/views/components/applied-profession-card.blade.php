<div class="card mb-3">
  <div class="card-body {{ $profession->isExpired() ? 'bg-warning' : '' }}">
    <p class="fs-5">
      @if ($profession->trashed())
        <del>
      @endif
      {{--  $title value will be used if it is passed, if not, title of profession will be used instead  --}}
      <a href="{{ $route }}" class="{{ $profession->trashed() ? 'text-muted' : '' }}">{{ $title ?? $profession->title }}</a>{{ $text }}
      @if ($profession->trashed())
        </del>
      @endif
    </p>
    <x-expired-badge :profession="$profession"></x-expired-badge>
  </div>
</div>