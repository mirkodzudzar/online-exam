@if ($professions->count() > 0)
  <table class="table table-striped">
    <thead class="table-dark">
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Title</th>
        <th scope="col">Candidates</th>
        <th scope="col">Questions</th>
        <th scope="col">Open date</th>
        <th scope="col">Close date</th>
        <th scope="col">Note</th>
        <th scope="col"></th>
        <th scope="col">
          <form action="{{ route('admins.professions.restore-all') }}" method="POST">
            @csrf
            <input type="submit" value="Restore all" class="btn btn-info" onclick='return confirm("Are you sure you want to restore all professions?")'>
          </form>
        </th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($professions as $profession)
        <tr>
          <th scope="row">{{ $profession->id }}</th>
          <td>
            <a href="{{ route('admins.professions.show', ['profession' => $profession]) }}" class="text-decoration-none">
              {{ $profession->title }}
            </a>
          </td>
          <td>{{ $profession->candidates_count }}</td>
          <td>{{ $profession->questions_count }}</td>
          <td>{{ $profession->open_date }}</td>
          <td>{{ $profession->close_date }}</td>
          <td>
            @include('includes._expired-badge')
          </td>
          <td>
            <a href="{{ route('admins.professions.edit', ['profession' => $profession->id]) }}" class="btn btn-success">Edit</a>
          </td>
          @if ($profession->trashed())
            <td>
              <form action="{{ route('admins.professions.restore', ['profession' => $profession->id]) }}" method="POST">
                @csrf
                <input type="submit" value="Restore" class="btn btn-warning">
              </form>
            </td>
            <td>
              <form action="{{ route('admins.professions.force-delete', ['profession' => $profession->id]) }}" method="POST">
                @csrf
                <input type="submit" value="Delete Permanently" class="btn btn-danger" 
                  onclick="return confirm('Are you sure you want to delete {{ $profession->title }} permanently? This action can not be undone!')">
              </form>
            </td>
          @else
            <td></td>
            <td>
              <form action="{{ route('admins.professions.destroy', ['profession' => $profession->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" value="Delete" class="btn btn-danger" onclick='return confirm("Are you sure you want to delete {{ $profession->title }}?")'>
              </form>
            </td>
          @endif
        </tr>
      @endforeach
    </tbody>
  </table>
@else
  <p>There are no professions!</p>
@endif