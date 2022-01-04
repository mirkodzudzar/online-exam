<div class="card">
  <div class="card-header">
    Result
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
          <td>{{ $candidate_profession->total }}</td>
          <td>{{ $candidate_profession->attempted }}</td>
          <td>{{ $candidate_profession->correct }}</td>
          <td>{{ $candidate_profession->wrong }}</td>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="2"></td>
          <td>Percentage</td>
          <td>
            @php
              $percentage = ($candidate_profession->correct / $candidate_profession->total) * 100;
            @endphp
            {{ round($percentage, 2) }} %
          </td>
        </tr>
        <tr>
          <td colspan="2"></td>
          <td>Status</td>
          @if ($candidate_profession->status === 'passed')
            <td class="table-success">{{ $candidate_profession->status }}</td>
          @else
            <td class="table-danger">{{ $candidate_profession->status }}</td>
          @endif
        </tr>
      </tfoot>
    </table>
  </div>
</div>