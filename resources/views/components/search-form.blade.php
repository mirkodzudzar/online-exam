<form action="{{ URL::current() }}" method="GET" class="mb-3">
  <div class="d-flex">
    <div class="input-group">
      @if (isset($result))
        <a href="{{ URL::current() }}" class="btn btn-outline-danger">X</a>
      @endif
      <input type="text" name="search" class="form-control"
             placeholder="{{ $placeholder ?? 'Search' }}" value="{{ $result ?? '' }}" required>
    </div>
    <input type="submit" class="btn btn-primary ms-3" value="Search">
  </div>
  @if (isset($result))
    <p class="mt-3">
      <i class="text-muted">Total results: </i>{{ $item->count() }},<i class="text-muted"> for term: </i>{{ $result }}
    </p>
  @endif
</form>