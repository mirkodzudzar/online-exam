@component('mail::message')
# Hi {{ $candidate->username }}.

You have successfully applied for the profession '{{ $profession->title }}'.

@component('mail::button', ['url' => route('users.professions.show', ['profession' => $profession->id])])
Visit profession
@endcomponent

@if ($profession->questions->count() > 0)
@component('mail::panel')
You could now complete the exam for this profession to have a better chance of success.
Please visit the profession exam and try to give the best answers to the questions. Good luck!
@component('mail::button', ['url' => route('users.candidates.professions.show', [
  'candidate' => $candidate->id,
  'profession' => $profession->id,
])])
Exam
@endcomponent
@endcomponent
@endif

If you would like to unapply you can do so at any time until the profession expires.
@component('mail::button', ['url' => route('users.professions.show', ['profession' => $profession->id])])
Unapply
@endcomponent

@component('mail::panel')
Deadline: {{ $profession->open_date }} - {{ $profession->close_date }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent