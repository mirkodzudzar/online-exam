@extends('layouts.admin')

@section('title', 'Candidates')
    
@section('content')
  <h1>List of all candidates <x-badge :value="$candidates_count" type="primary"></x-badge></h1>
  @if ($candidates->count() > 0)
    <table class="table table-striped">
      <thead class="table-dark">
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Username</th>
          <th scope="col">Phone number</th>
          <th scope="col">State</th>
          <th scope="col">City</th>
          <th scope="col">Address</th>
          <th scope="col">Created at</th>
          <th scope="col">Updated at</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($candidates as $candidate)
          <tr>
            <th scope="row">{{ $candidate->id }}</th>
            <td>{{ $candidate->user->name }}</td>
            <td>{{ $candidate->user->email }}</td>
            <td>{{ $candidate->username }}</td>
            <td>{{ $candidate->phone_number }}</td>
            <td>{{ $candidate->state }}</td>
            <td>{{ $candidate->city }}</td>
            <td>{{ $candidate->address }}</td>
            <td>{{ $candidate->created_at }}</td>
            <td>{{ $candidate->updated_at }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @else
    <p>There are no candidates!</p>
  @endif
@endsection