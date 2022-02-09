@extends('layouts.user')

@section('title', 'List of your exams')

@section('page_title', 'List of your exams')
    
@section('content')
  <div class="row">
    <div>
      @forelse ($exams as $exam)
        <h3>{{ $exam->title }}</h3>
        @foreach ($exam->professions as $profession)
          @if(Auth::user()->candidate->professions->contains($profession->id))
            <x-applied-profession-card
              :route="route('professions.show', [
                'profession' => $profession->id,
              ])"
              :profession="$profession">
            </x-applied-profession-card>
          @endif
        @endforeach
      @empty
        <p>You do not have any exams yet.</p>
      @endforelse
    </div>
  </div>
@endsection