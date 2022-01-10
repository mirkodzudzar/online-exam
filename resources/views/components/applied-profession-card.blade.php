<div class="card mb-3">
  <div class="card-body {{ Carbon\Carbon::parse($profession->close_date) < Carbon\Carbon::today() ? 'bg-warning' : '' }}">
    <p class="fs-5">
      {{--  $title value will be used if it is passed, if not, title of profession will be used instead  --}}
      <a href="{{ $route }}" class="text-decoration-none">{{ $title ?? $profession->title }}</a>{{ $text }}
    </p>
    <x-expired-badge :profession="$profession"></x-expired-badge>
  </div>
</div>