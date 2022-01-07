@extends('layouts.admin')

@section('title', $profession->title)
    
@section('content')
  <p class="text-muted"><i>Posted {{ $profession->created_at->diffForHumans() }}.</i></p>

  @if ($profession->trashed())
    <del>
  @endif
  <h1 class="card-title {{ $profession->trashed() ? 'text-muted' : '' }}">{{ $profession->title }}</h1>
  <div class="mb-3">
    @include('includes._expired-badge')
  </div>
  @if ($profession->trashed())
    </del>
  @endif
  <p>{{ $profession->description }}</p>
  <p>
    <x-badge :value="$profession->open_date" type="dark"></x-badge>
    <b> - </b>
    <x-badge :value="$profession->close_date" type="danger"></x-badge>
  </p>

  <div class="card">
    <div class="card-header">
      <ul class="nav nav-tabs card-header-tabs">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admins.professions.show', ['profession' => $profession->id]) }}">Questions</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="true" href="{{ route('admins.candidates.professions.results', ['profession' => $profession->id]) }}">Results</a>
        </li>
      </ul>
    </div>
    <div class="card-body">
      @if ($candidate_professions->count() > 0)
        <div class="row">
          <div class="col-md-6">
            <h3>Attempted</h3>
            @forelse ($candidate_professions as $candidate_profession)
              @if ($candidate_profession->status !== 'applied')
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
                <x-applied-profession-card
                  :route="route('admins.candidates.show', ['candidate' => $candidate_profession->candidate->id ])"
                  :title="$candidate_profession->candidate->user->email"
                  text=", applied {{ $candidate_profession->created_at->diffForHumans() }}.">
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
    </div>
  </div>
@endsection