{{--  This two includes current date also - not ideal option  --}}
{{--  @if (Carbon\Carbon::parse($profession->close_date) < Carbon\Carbon::now())  --}}
{{--  @if (Carbon\Carbon::parse($profession->close_date)->isPast())  --}}
{{--  This option includes only dates before today  --}}
@if($profession->isExpired()))
  <span class="badge bg-danger">Expired</span>
@endif