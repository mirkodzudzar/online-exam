@if ($locations->count() > 0)
  <p>
    @if (isset($icon))
      <x-geo-icon></x-geo-icon>
    @endif
    @foreach ($locations as $location)
      {{-- Only for admin routes, link will be to admin location candidates page --}}
      @if (Route::is('admins.*'))
        <a href="{{ route('admins.locations.candidates', ['location' => $location->id]) }}" class="text-decoration-none">
      @else
        <a href="{{ route('locations.show', ['location' => $location->id]) }}" class="text-decoration-none">
      @endif
        {{ $location->name }}
      </a>
      {{ $loop->last ? '' : "|" }}
    @endforeach
    @auth
      @if (!Auth::user()->is_admin && Auth::user()->candidate->location)
        @if ($locations->contains(Auth::user()->candidate->location))
          <x-badge value="May be near you!" type="info"></x-badge>
        @endif
      @endif
    @endauth
  </p>
@endif