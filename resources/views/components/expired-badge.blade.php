@if ($profession->close_date < Carbon\Carbon::now())
  <span class="badge bg-danger">Expired</span>
@endif