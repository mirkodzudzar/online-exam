@extends('layouts.admin')

@section('title', 'Admin users')

@section('page_title', 'List of all admin users')
    
@section('content')
  <x-search-form placeholder="Search for users"
                :item="$users"
                :result="$result ?? null">
  </x-search-form>
  <table class="table table-responsive table-hover table-striped w-100 d-block d-md-table">
    <thead class="table-dark">
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Role</th>
        <th scope="col">Created at</th>
        <th scope="col">Updated at</th>
        <th scope="col">Options</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
        <tr>
          <th scope="row">{{ $user->id }}</th>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <th>{{ $user->is_admin ? 'admin' : 'error' }}</th>
          <td>{{ $user->created_at }}</td>
          <td>{{ $user->updated_at }}</td>
          <td><a href="{{ route('admins.users.edit', ['user' => $user->id]) }}" class="btn btn-success">Edit</a></td>
        </tr>
      @endforeach
    </tbody>
  </table>
  <x-pager :items="$users"></x-pager>
@endsection