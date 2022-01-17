@if ($locations->count() > 0)
  <p class="fs-5">
    <x-geo-icon></x-geo-icon>
    @foreach ($locations as $location)
      <a href="{{ route('users.locations.show', ['location' => $location->id]) }}" class="text-decoration-none">
        {{ $location->name }}
      </a>
      {{ $loop->last ? '' : "|" }}
    @endforeach
  </p>
@endif