@extends('layouts.user')

@section('title', 'List of your professions')

@section('page_title', 'List of your professions')
    
@section('content')
  <div class="row">
    <div>
      @forelse ($candidate_professions as $candidate_profession)
        <x-profession-card-list
          :route="route('professions.show', [
            'profession' => $candidate_profession->profession->id,
          ])"
          :profession="$candidate_profession->profession">
        </x-profession-card-list>
      @empty
        <p>You do not have any results yet.</p>
      @endforelse
    </div>
  </div>
  <x-pager :items="$candidate_professions"></x-pager>
@endsection