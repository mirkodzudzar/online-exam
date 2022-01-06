@extends('layouts.admin')

@section('title', 'Questions')
    
@section('content')
  <h1>List of all questions <x-badge :value="$questions_count" type="primary"></x-badge></h1>
  @if ($questions->count() > 0)
    <table class="table table-striped">
      <thead class="table-dark">
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Question</th>
          <th scope="col">Profession</th>
          <th scope="col">Answer A</th>
          <th scope="col">Answer B</th>
          <th scope="col">Answer C</th>
          <th scope="col">Answer D</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($questions as $question)
          <tr>
            <th>{{ $question->id }}</th>
            <td>{{ $question->question }}</td>
            <th>{{ $question->profession->title }}</th>
            <td class="{{ $question->answer_correct === 'answer_a' ? 'text-success' : '' }}">{{ $question->answer_a }}</td>
            <td class="{{ $question->answer_correct === 'answer_b' ? 'text-success' : '' }}">{{ $question->answer_b }}</td>
            <td class="{{ $question->answer_correct === 'answer_c' ? 'text-success' : '' }}">{{ $question->answer_c }}</td>
            <td class="{{ $question->answer_correct === 'answer_d' ? 'text-success' : '' }}">{{ $question->answer_d }}</td>
            <td><a href="{{ route('admins.questions.edit', ['question' => $question->id]) }}" class="btn btn-success">Edit</a></td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @else
    <p>There are no questions!</p>
  @endif
@endsection