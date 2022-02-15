@extends('layouts.admin')

@section('title', $profession->title)
    
@section('content')

  @include('includes._profession-show')

  <div class="card">
    
    @include('includes._admin-profession-card-header')

    <div class="card-body">
      <div class="row">
        @forelse ($candidate_professions as $candidate_profession)
          <x-profession-card-list
            :route="route('admins.candidates.show', ['candidate' => $candidate_profession->candidate->id ])"
            :title="$candidate_profession->candidate->user->email"
            :profession="$candidate_profession->profession"
            text=", applied {{ $candidate_profession->created_at->diffForHumans() }}.">
          </x-profession-card-list>
        @empty
          <p>You do not have any results yet.</p>
        @endforelse
      </div>
    </div>
  </div>
@endsection