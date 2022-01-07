@extends('layouts.user')

@section('title', 'Your results')

@section('page_title', 'Your results')
    
@section('content')
  @if ($candidate_professions->count() > 0)
    <div class="row">
      <div class="col-md-6">
        <h3>Attempted</h3>
        @foreach ($candidate_professions as $candidate_profession)
          @if ($candidate_profession->status !== 'applied')
            {{-- @include('includes._profession-results') --}}
            <x-profession-results :value="$candidate_profession"></x-profession-results>
          @endif
        @endforeach
      </div>
      <div class="col-md-6">
        <h3>Applied</h3>
        @foreach ($candidate_professions as $candidate_profession)
          @if ($candidate_profession->status === 'applied')
            <div class="card">
              <div class="card-body">
                Finish the exam {{ $candidate_profession->profession }}
                {{-- <a href="{{ route('users.candidates.professions.update', [
                  'candidate' => $candidate_profession->candidate->id,
                  'profession' => $candidate_profession->profession->id,
                ]) }}"></a>  --}}
              </div>
            </div>
          @endif
        @endforeach
      </div>
    </div>
  @else
    <p>You do not have any results yet.</p>
  @endif
@endsection