<div class="d-flex">
  @if (Route::is('locations.show'))
    <a href="{{ route('admins.locations.candidates', ['location' => $location->id]) }}" class="btn btn-primary me-2">View</a>
  @endif
  <a href="{{ route('admins.locations.edit', ['location' => $location->id]) }}" class="btn btn-success me-2">Edit</a>
  @can('enable', $location)
    <form action="{{ route('admins.locations.enable', ['location' => $location->id]) }}"
          method="POST"
          class="me-2">
      @csrf
      <input type="submit" value="Enable" class="btn btn-warning">
    </form>
  @elsecan('disable', $location)
    <form action="{{ route('admins.locations.disable', ['location' => $location->id]) }}"
          method="POST"
          class="me-2">
      @csrf
      <input type="submit" value="Disable" class="btn btn-danger">
    </form>
  @endcan
</div>