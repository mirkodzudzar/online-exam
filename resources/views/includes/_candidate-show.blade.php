<table class="table table-striped text-center">
  <tr>
    <th>Id</th>
    <th>{{ $candidate->id }}</th>
  </tr>
  <tr>
    <th>Name</th>
    <td>{{ $candidate->user->name }}</td>
  </tr>
  <tr>
    <th>Email</th>
    <td>{{ $candidate->user->email }}</td>
  </tr>
  <tr>
    <th>Username</th>
    <td>{{ $candidate->username }}</td>
  </tr>
  <tr>
    <th>Phone number</th>
    <td>{{ $candidate->phone_number }}</td>
  </tr>
  <tr>
    <th>State</th>
    <td>{{ $candidate->state }}</td>
  </tr>
  <tr>
    <th>City</th>
    <td>{{ $candidate->city }}</td>
  </tr>
  <tr>
    <th>Address</th>
    <td>{{ $candidate->address }}</td>
  </tr>
  <tr>
    <th>Location</th>
    <td>
      @if ($candidate->location)
        @if (Auth::check() && Auth::user()->is_admin)
          <a href="{{ route('admins.locations.candidates', ['location' => $candidate->location->id]) }}" class="text-decoration-none">
            {{ $candidate->location->name }}
          </a>
        @else
          <a href="{{ route('users.locations.show', ['location' => $candidate->location->id]) }}" class="text-decoration-none">
            {{ $candidate->location->name }}
          </a>
        @endif
      @else
        <p>/</p>
      @endif
    </td>
  </tr>
  <tr>
    <th>Created At</th>
    <td>{{ $candidate->created_at }}</td>
  </tr>
  <tr>
    <th>Updated At</th>
    <td>{{ $candidate->updated_at }}</td>
  </tr>
</thead>
</table>