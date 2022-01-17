@extends('layouts.admin')

@section('title', "Candidate - {$candidate->user->email}")

@section('page_title', "Candidate - {$candidate->user->email}")
    
@section('content')
  <table class="table table-striped text-center">
      <tr>
        <th>Id</th>
        <td>{{ $candidate->id }}</td>
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
        <td>{{ optional($candidate->location ?? null)->name }}</td>
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
  <div class="row mt-3">
    <div class="col-md-6">
      <h3>Attempted</h3>
      @forelse ($candidate_professions as $candidate_profession)
        @if ($candidate_profession->status !== 'applied')
          {{-- Profession table with the results --}}
          <x-profession-results :value="$candidate_profession"></x-profession-results>
        @endif
      @empty
        <p>No results.</p>
      @endforelse
    </div>
    <div class="col-md-6">
      <h3>Applied</h3>
      @forelse ($candidate_professions as $candidate_profession)
        @if ($candidate_profession->status === 'applied')
          {{-- Profession table with the applied professions --}}
          <x-applied-profession-card
            :route="route('admins.professions.show', ['profession' => $candidate_profession->profession->id])"
            :profession="$candidate_profession->profession"
            text=" profession, applied {{ $candidate_profession->created_at->diffForHumans() }}.">
          </x-applied-profession-card>
        @endif
      @empty
        <p>No results.</p>
      @endforelse
    </div>
  </div>
@endsection