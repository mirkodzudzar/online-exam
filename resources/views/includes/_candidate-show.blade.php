<table class="table table-responsive table-hover table-striped text-center w-100 d-block d-md-table">
  <tr>
    <th scope="row">Profile image</th>
    <td>
      <img src="{{ Storage::url($candidate->profile_thumbnail) }}">
    </td>
  </tr>
  <tr>
    <th scope="row">Id</th>
    <td>{{ $candidate->id }}</td>
  </tr>
  <tr>
    <th scope="row">Name</th>
    <td>{{ $candidate->user->name }}</td>
  </tr>
  <tr>
    <th scope="row">Email</th>
    <td>{{ $candidate->user->email }}</td>
  </tr>
  <tr>
    <th scope="row">Username</th>
    <td>{{ $candidate->username }}</td>
  </tr>
  <tr>
    <th scope="row">Phone number</th>
    <td>{{ $candidate->phone_number }}</td>
  </tr>
  <tr>
    <th scope="row">State</th>
    <td>{{ $candidate->state }}</td>
  </tr>
  <tr>
    <th scope="row">City</th>
    <td>{{ $candidate->city }}</td>
  </tr>
  <tr>
    <th scope="row">Address</th>
    <td>{{ $candidate->address }}</td>
  </tr>
  <tr>
    <th scope="row">Location</th>
    <td>
      @if ($candidate->location)
        @if (Auth::check() && Auth::user()->is_admin)
          <a href="{{ route('admins.locations.candidates', ['location' => $candidate->location->id]) }}">
            {{ $candidate->location->name }}
          </a>
        @else
          <a href="{{ route('locations.show', ['location' => $candidate->location->id]) }}">
            {{ $candidate->location->name }}
          </a>
        @endif
      @else
        <p>/</p>
      @endif
    </td>
  </tr>
  <tr>
    <th scope="row">CV document</th>
    <td>
      @if ($candidate->document)
        <p>
          <a href="{{ Storage::url($candidate->document->path) }}" target="_blank">Preview CV</a>
        </p>
      @else
        <p>/</p>
      @endif
    </td>
  </tr>
  <tr>
    <th scope="row">Created At</th>
    <td>{{ $candidate->created_at }}</td>
  </tr>
  <tr>
    <th scope="row">Updated At</th>
    <td>{{ $candidate->updated_at }}</td>
  </tr>
</thead>
</table>