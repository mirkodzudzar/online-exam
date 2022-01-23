@extends('layouts.admin')

@section('title', "Candidate - {$candidate->user->email}")

@section('page_title', "Candidate - {$candidate->user->email}")
    
@section('content')

  @include('includes._candidate-show')

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