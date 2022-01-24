<div class="card mb-3 {{ $value->profession->isExpired() ? 'bg-warning' : '' }}">
  <div class="card-header">
    <p class="fs-5">
      @if ($value->trashed())
        <del>
      @endif
      @if (Route::is('admins.candidates.show'))
        <a href="{{ route('admins.professions.show', ['profession' => $value->profession->id]) }}" class="text-decoration-none">{{ $value->profession->title }}</a>
      @elseif (Route::is('admins.candidates.professions.results'))
        <a href="{{ route('admins.candidates.show', ['candidate' => $value->candidate->id]) }}" class="text-decoration-none">{{ $value->candidate->user->email }}</a>
      @else
        <a href="{{ route('professions.show', ['profession' => $value->profession->id]) }}" class="text-decoration-none">{{ $value->profession->title }}</a>
      @endif
      result, attempted {{ $value->updated_at->diffForHumans() }}.
      @if ($value->trashed())
        </del>
      @endif
    </p>
    <x-expired-badge :profession="$value->profession"></x-expired-badge>
  </div>
  <div class="card-body">
    <table class="table table-striped">
      <thead class="table-dark">
        <tr>
          <th scope="col">Total</th>
          <th scope="col">Attempted</th>
          <th scope="col">Correct</th>
          <th scope="col">Wrong</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{ $value->total }}</td>
          <td>{{ $value->attempted }}</td>
          <td>{{ $value->correct }}</td>
          <td>{{ $value->wrong }}</td>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="2"></td>
          <td>Percentage</td>
          <td>
            @php
              $percentage = ($value->correct / $value->total) * 100;
            @endphp
            {{ round($percentage, 2) }} %
          </td>
        </tr>
        <tr>
          <td colspan="2"></td>
          <td>Status</td>
          @if ($value->status === 'passed')
            <td class="table-success">{{ $value->status }}</td>
          @else
            <td class="table-danger">{{ $value->status }}</td>
          @endif
        </tr>
      </tfoot>
    </table>
  </div>
</div>