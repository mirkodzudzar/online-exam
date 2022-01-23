@component('mail::message')

# Hi {{ $user->name }}.

Candidate {{ $candidate_profession->candidate->username }} has finished the exam for profession '{{ $candidate_profession->profession->title }}'.

@if ($candidate_profession->status === 'passed')
## Candidate successfully passed the exam! Here are the results.
@else
## Candidate did not pass the exam. Here are the results.
@endif

@component('mail::panel')
@php
  $percentage = ($candidate_profession->correct / $candidate_profession->total) * 100;
@endphp
@component('mail::table')
| Total                              | Attempted                              | Correct                              | Wrong                                |
|:----------------------------------:|:--------------------------------------:|:------------------------------------:|:------------------------------------:|
| {{ $candidate_profession->total }} | {{ $candidate_profession->attempted }} | {{ $candidate_profession->correct }} | {{ $candidate_profession->wrong }}   |
|                                    |                                        |                                      |                                      |
|                                    |                                        | Percentage                           | {{ round($percentage, 2) }} %        |
|                                    |                                        | Status                               | {{ $candidate_profession->status }}  |
@endcomponent
@endcomponent

Additionally, you can see the results for this candidate on the website.

@component('mail::button', ['url' => route('admins.candidates.show', [
  'candidate' => $candidate_profession->candidate->id,
])])
Visit the candidate results
@endcomponent

@if ($candidate_profession->candidate->document)
Here is candidate CV
@component('mail::button', ['url' => Storage::url($candidate_profession->candidate->document->path)])
CV document
@endcomponent
@endif

Thanks,<br>
{{ config('app.name') }}
@endcomponent