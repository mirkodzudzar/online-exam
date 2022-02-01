
  @if ($candidates->count() > 0)
  <table class="table table-responsive table-hover table-striped w-100 d-block d-md-table">
    <thead class="table-dark">
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Username</th>
        <th scope="col">Phone number</th>
        <th scope="col">Professions</th>
        <th scope="col">Location</th>
        <th scope="col">CV document</th>
        <th scope="col">Created at</th>
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
                {{ $candidate->location->name }}
              </a>
            @else
              <p>/</p>
            @endif
          </td>
          <td>
            @if ($candidate->document)
              <p>
                <a href="{{ Storage::url($candidate->document->path) }}" target="_blank" class="text-decoration-none">Preview CV</a>
              </p>
            @else
              <p>/</p>
            @endif
          </td>
          <td>{{ $candidate->created_at }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
@else
  <p>There are no candidates!</p>
@endif
<x-pager :items="$candidates"></x-pager>