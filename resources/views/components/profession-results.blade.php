<div class="card mb-3">
  <div class="card-header fs-3">
    <p>
      @if (Route::is('admins.candidates.show'))
        <a href="{{ route('admins.professions.show', ['profession' => $value->profession->id]) }}" class="text-decoration-none">{{ $value->profession->title }}</a>
      @else
        <a href="{{ route('users.professions.show', ['profession' => $value->profession->id]) }}" class="text-decoration-none">{{ $value->profession->title }}</a>
      @endif
      result
    </p>
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