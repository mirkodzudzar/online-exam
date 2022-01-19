
  @if ($candidates->count() > 0)
  <table class="table table-striped">
    <thead class="table-dark">
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Username</th>
        <th scope="col">Phone number</th>
        <th scope="col">Professions</th>
        <th scope="col">Location</th>
        {{-- <th scope="col">State</th>
        <th scope="col">City</th>
        <th scope="col">Address</th> --}}
        <th scope="col">Created at</th>
        <th scope="col">Updated at</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($candidates as $candidate)
        <tr>
          <th scope="row">{{ $candidate->id }}</th>
          <td><a href="{{ route('admins.candidates.show', ['candidate' => $candidate->id]) }}" class="text-decoration-none">{{ $candidate->user->name }}</a></td>
          <td>{{ $candidate->user->email }}</td>
          <td>{{ $candidate->username }}</td>
          <td>{{ $candidate->phone_number }}</td>
          <td>{{ $candidate->professions_count }}</td>
          <td>
            @if ($candidate->location) 
              <a href="{{ route('admins.locations.candidates', ['location' => $candidate->location->id]) }}" class="text-decoration-none"> 
                {{ optional($candidate->location ?? null)->name }}
              </a>
            @else
              <p>/</p>
            @endif
          </td>
          {{-- <td>{{ $candidate->state }}</td>
          <td>{{ $candidate->city }}</td>
          <td>{{ $candidate->address }}</td> --}}
          <td>{{ $candidate->created_at }}</td>
          <td>{{ $candidate->updated_at }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
@else
  <p>There are no candidates!</p>
@endif
<x-pager :items="$candidates"></x-pager>