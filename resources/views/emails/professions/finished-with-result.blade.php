@component('mail::message')
# Hi {{ $candidate_profession->candidate->username }}.

You have finished the exam for the profession '{{ $candidate_profession->profession->title }}'.

@if ($candidate_profession->status === 'passed')
## Congratulations, you have successfully passed the exam! Here are the results.
@else
## Unfortunately, you did not pass the exam. Here are the results.
@endif

@component('mail::panel')
@component('mail::table')
| Total                              | Attempted                              | Correct                              | Wrong                                            |
|:----------------------------------:|:--------------------------------------:|:------------------------------------:|:------------------------------------------------:|
| {{ $candidate_profession->total }} | {{ $candidate_profession->attempted }} | {{ $candidate_profession->correct }} | {{ $candidate_profession->wrong }}               |
|                                    |                                        |                                      |                                                  |
|                                    |                                        | Percentage                           | {{ $candidate_profession->percentage }} %        |
|                                    |                                        | Status                               | {{ $candidate_profession->status }}              |
@endcomponent
@endcomponent

Additionally, you can see the results for this profession on the website.

@component('mail::button', ['url' => route('users.candidates.professions.exams.results', [
  'candidate' => $candidate_profession->candidate->id,
  'profession' => $candidate_profession->profession->id,
  'exam' => $candidate_profession->profession->exam->id,
])])
Visit the result
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent