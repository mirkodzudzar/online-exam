@extends('layouts.admin')

@section('title', 'Exams')
    
@section('page_title', 'List of all exams')

@section('content')
@if ($exams->count() > 0)
<table class="table table-responsive table-hover table-striped w-100 d-block d-md-table">
  <thead class="table-dark">
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Professions</th>
      <th scope="col">Questions</th>
      <th scope="col">Options</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($exams as $exam)
      <tr>
        <th scope="row">{{ $exam->id }}</th>
        <td><a href="{{ route('admins.exams.professions', ['exam' => $exam->id]) }}">{{ $exam->title }}</a></td>
        <td>{{ Str::limit($exam->description, 50) }}</td>
        <td>{{ $exam->professions_count }}</td>
        <td></td>
        <td>
          @include('includes._admin-exam-options')
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
@else
<p>There are no exams!</p>
@endif
<x-pager :items="$exams"></x-pager>
@endsection