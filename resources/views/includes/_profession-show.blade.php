<p class="text-muted"><i>Posted {{ $profession->created_at->diffForHumans() }}.</i></p>

<x-expired-badge :profession="$profession"></x-expired-badge>

@if ($profession->trashed())
  <del>
@endif
<h1 class="card-title {{ $profession->trashed() ? 'text-muted' : '' }}">{{ $profession->title }}</h1>
@if ($profession->trashed())
  </del>
@endif
<p>{{ $profession->description }}</p>

@auth
  @if (Auth::user()->is_admin)
    <p>Exam: <a href="{{ route('admins.exams.professions', ['exam' => $profession->exam->id]) }}">{{ $profession->exam->title }}</a></p>
  @endif
@endauth

<x-location :locations="$profession->locations" :icon="true"></x-location>

<x-date-range :profession="$profession"></x-date-range>

@if (Route::is('professions.show'))
  <p class="mt-2"><i class="text-muted">Number of users currently visiting this profession: </i>{{ $counter }}</p>
@endif

@auth
  @if (Auth::user()->is_admin)
    <div class="mb-3 mt-3">
      @include('includes._admin-profession-options')
    </div>
  @endif
@endauth

@can('view', $profession->exam)
  <a href="{{ route('users.candidates.professions.exams.show', [
    'candidate' => Auth::user()->candidate->id,
    'profession' => $profession->id, 
    'exam' => $profession->exam->id
    ]) }}" class="btn btn-outline-info">
    Exam
  </a>
@endcan

@can('results', App\Models\CandidateExam::where('candidate_id', Auth::user()->candidate->id)->where('exam_id', $profession->exam->id)->first())
  <a href="{{ route('users.candidates.professions.exams.results', [
    'candidate' => Auth::user()->candidate->id,
    'profession' => $profession->id,
    'exam' => $profession->exam->id
    ]) }}" class="btn btn-outline-info">Result</a>
@endcan

@can('unapply', $profession)
  @include('includes._unapply-button')
  @cannot('view', $profession->exam)
    {{--  This message will be dispalyed once we applie for some profession, which exam has been finished already on some another profession!  --}}
    <p class="mt-2">You do not need to attempt the exam, because you have already finished the exam for simillar profession!</p>
  @endcannot
@elsecan('apply', $profession)
  @include('includes._apply-button')
@else
  @guest
    <a href="{{ route('login') }}" class="btn btn-primary">Login to apply</a>
  @endguest
@endcan

@auth
  @if (!Auth::user()->is_admin && isset($candidate_profession->status))
    @if ($candidate_profession->status === 'unapplied')
      <x-badge value="You have already unapplied from this profession, {{ $candidate_profession->updated_at->diffForHumans() }}" type="danger"></x-badge>
    @endif
  @endif
@endauth