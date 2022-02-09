@extends('layouts.user')

@section('title', 'List of your professions')

@section('page_title', 'List of your professions')
    
@section('content')
  <div class="row">
    <div>
      @forelse ($candidate_professions as $candidate_profession)
        {{-- Profession table with the applied professions --}}
        <x-applied-profession-card
          :route="route('professions.show', [
            'profession' => $candidate_profession->profession->id,
          ])"
          :profession="$candidate_profession->profession">
        </x-applied-profession-card>
      @empty
        <p>You do not have any results yet.</p>
      @endforelse
    </div>
  </div>
  <x-pager :items="$candidate_professions"></x-pager>
@endsection