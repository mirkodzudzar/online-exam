@extends('layouts.user')

@section('title', 'Home page')

@section('page_title', 'List of professions')
    
@section('content')
  <form action="{{ route('professions.index') }}" method="GET" class="mb-3">
    <div class="d-flex">
      <div class="input-group">
        @if (isset($result))
          <a href="{{ route('professions.index') }}" class="btn btn-outline-danger">X</a>
        @endif
        <input type="text" name="search" class="form-control"
               placeholder="Search for profession" value="{{ $result ?? '' }}" required>
      </div>
      <input type="submit" class="btn btn-primary ms-3" value="Search">
    </div>
    @if (isset($result))
      <p class="mt-3">
        <i class="text-muted">Total results: </i>{{ $professions->count() }},<i class="text-muted"> for term: </i>{{ $result }}
      </p>
    @endif
  </form>
  <x-profession-card :professions="$professions"></x-profession-card>
  <x-pager :items="$professions"></x-pager>
@endsection