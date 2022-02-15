@extends('admins.layouts.exam')
    
@section('exam_content')
  @if ($professions->count() > 0)
    <div>
      @include('includes._admin-profession-table')
    </div>
  @else
    <p>No professions yet.</p>
  @endif
@endsection