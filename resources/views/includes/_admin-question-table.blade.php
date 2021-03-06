@if ($questions->count() > 0)
  <table class="table table-responsive table-hover table-striped">
    <thead class="table-dark">
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Question</th>
        <th scope="col">Exam</th>
        <th scope="col">Answer A</th>
        <th scope="col">Answer B</th>
        <th scope="col">Answer C</th>
        <th scope="col">Answer D</th>
        <th scope="col">Options</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($questions as $question)
        <tr>
          <th scope="row">{{ $question->id }}</th>
          <td>
            @if ($question->trashed())
              <del>
            @endif
            <p class="{{ $question->trashed() ? 'text-muted' : '' }}">{{ Str::limit($question->text, 50) }}</p>
            @if ($question->trashed())
              </del>
            @endif
          </td>
          <td>
            <a href="{{ route('admins.exams.questions', ['exam' => $question->exam ]) }}">{{ $question->exam->title }}</a>
          </td>
          <td class="{{ $question->answer_correct === 'answer_a' ? 'text-success' : '' }}">{{ $question->answer_a }}</td>
          <td class="{{ $question->answer_correct === 'answer_b' ? 'text-success' : '' }}">{{ $question->answer_b }}</td>
          <td class="{{ $question->answer_correct === 'answer_c' ? 'text-success' : '' }}">{{ $question->answer_c }}</td>
          <td class="{{ $question->answer_correct === 'answer_d' ? 'text-success' : '' }}">{{ $question->answer_d }}</td>
          <td>
            @include('includes._admin-question-options')
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@else
  <p>There are no questions!</p>
@endif