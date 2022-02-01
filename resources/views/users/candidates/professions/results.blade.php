@extends('layouts.user')

@section('title', 'Your results')
    
@section('content')
  <h1>Your results <x-badge :value="$candidate_professions->count()" type="primary"></x-badge></h1>
  @if ($candidate_professions->count() > 0)
    <div class="row">
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
              :route="route('professions.show', [
                'profession' => $candidate_profession->profession->id,
              ])"
              :profession="$candidate_profession->profession"
              text=" profession exam, applied {{ $candidate_profession->created_at->diffForHumans() }}.">
            </x-applied-profession-card>
          @endif
        @empty
          <p>No results.</p>
        @endforelse
      </div>
    </div>
  @else
    <p>You do not have any results yet.</p>
  @endif
@endsection