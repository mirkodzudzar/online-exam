<table class="table table-striped">
  <thead class="table-dark">
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Title</th>
      <th scope="col">Open date</th>
      <th scope="col">Close date</th>
      <th scope="col">Note</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($professions as $profession)
      <tr>
        <th scope="row">{{ $profession->id }}</th>
        <td>{{ $profession->title }}</td>
        <td>{{ $profession->open_date }}</td>
        <td>{{ $profession->close_date }}</td>
        <td>
          <x-expired-badge :profession="$profession"></x-expired-badge>
        </td>
      </tr>
    @empty
      <p>There are no professions!</p>
    @endforelse
  </tbody>
</table>