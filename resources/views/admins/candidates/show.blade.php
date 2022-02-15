@extends('layouts.admin')

@section('title', "Candidate - {$candidate->user->email}")

@section('page_title', "Candidate - {$candidate->user->email}")
    
@section('content')

  @include('includes._candidate-show')

  <div class="row mt-3">
    @forelse ($candidate_professions as $candidate_profession)
      <x-profession-card-list
        :route="route('admins.professions.show', ['profession' => $candidate_profession->profession->id])"
        :profession="$candidate_profession->profession"
        text=" profession, applied {{ $candidate_profession->created_at->diffForHumans() }}.">
      </x-profession-card-list>
    @empty
      <p>No results.</p>
    @endforelse
  </div>
@endsection