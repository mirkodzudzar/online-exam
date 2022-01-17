@if ($professions->count() > 0)
  <table class="table table-striped">
    <thead class="table-dark">
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Title</th>
        <th scope="col">Candidates</th>
        <th scope="col">Questions</th>
        <th scope="col">Locations</th>
        <th scope="col">Open date</th>
        <th scope="col">Close date</th>
        <th scope="col">Note</th>
        <th scope="col"></th>
        {{--  <th scope="col">
          <form action="{{ route('admins.professions.restore-all') }}" method="POST">
            @csrf
            <input type="submit" value="Restore all" class="btn btn-info" onclick='return confirm("Are you sure you want to restore all professions?")'>
          </form>
        </th>  --}}
      </tr>
    </thead>
    <tbody>
      @foreach ($professions as $profession)
        <tr>
          <th scope="row">{{ $profession->id }}</th>
          <td>
            @if ($profession->trashed())
              <del>
            @endif
            <a href="{{ route('admins.candidates.professions.results', ['profession' => $profession]) }}" class="text-decoration-none {{ $profession->trashed() ? 'text-muted' : '' }}">
              {{ $profession->title }}
            </a>
            @if ($profession->trashed())
              </del>
            @endif
          </td>
          <td>{{ $profession->candidates_count }}</td>
          <td>{{ $profession->questions_count }}</td>
          <td>
            @foreach ($profession->locations as $location)
              {{ $location->name }}
              {{ $loop->last ? '' : "|" }}
            @endforeach
          </td>
          <td>{{ $profession->open_date }}</td>
          <td>{{ $profession->close_date }}</td>
          <td>
            <x-expired-badge :profession="$profession"></x-expired-badge>
          </td>
          <td>
            @include('includes._admin-profession-options')
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@else
  <p>There are no professions!</p>
@endif