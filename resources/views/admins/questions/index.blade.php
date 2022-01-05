@extends('layouts.admin')

@section('title', 'Questions')
    
@section('content')
  <h1>List of all questions <x-badge :value="$questions_count" type="primary"></x-badge></h1>
  @if ($questions->count() > 0)
    <table class="table table-striped">
      <thead class="table-dark">
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Profession</th>
          <th scope="col">Question</th>
          <th scope="col">Answer A</th>
          <th scope="col">Answer B</th>
          <th scope="col">Answer C</th>
          <th scope="col">Answer D</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($questions as $question)
          <tr>
            <th scope="row">{{ $question->id }}</th>
            <th scope="row">{{ $question->profession->title }}</th>
            <td>{{ $question->question }}</td>
            <td class="{{ $question->answer_a === $question->answer_correct ? 'bg-success text-white' : '' }}">{{ $question->answer_a }}</td>
            <td class="{{ $question->answer_b === $question->answer_correct ? 'bg-success text-white' : '' }}">{{ $question->answer_b }}</td>
            <td class="{{ $question->answer_c === $question->answer_correct ? 'bg-success text-white' : '' }}">{{ $question->answer_c }}</td>
            <td class="{{ $question->answer_d === $question->answer_correct ? 'bg-success text-white' : '' }}">{{ $question->answer_d }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @else
    <p>There are no questions!</p>
  @endif
@endsection