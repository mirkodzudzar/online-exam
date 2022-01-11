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
        <th colspan="3"></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($questions as $question)
        <tr>
          <th>{{ $question->id }}</th>
          <th>
            @if ($question->trashed())
              <del>
            @endif
            <p class="{{ $question->trashed() ? 'text-muted' : '' }}">{{ Str::limit($question->question, 50) }}</p>
            @if ($question->trashed())
              </del>
            @endif
          </th>
          <th>
            <a href="{{ route('admins.professions.show', ['profession' => $question->profession]) }}" class="text-decoration-none">{{ $question->profession->title }}</a>
          </th>
          <td class="{{ $question->answer_correct === 'answer_a' ? 'text-success' : '' }}">{{ $question->answer_a }}</td>
          <td class="{{ $question->answer_correct === 'answer_b' ? 'text-success' : '' }}">{{ $question->answer_b }}</td>
          <td class="{{ $question->answer_correct === 'answer_c' ? 'text-success' : '' }}">{{ $question->answer_c }}</td>
          <td class="{{ $question->answer_correct === 'answer_d' ? 'text-success' : '' }}">{{ $question->answer_d }}</td>
          <td>
            <a href="{{ route('admins.questions.edit', ['question' => $question->id]) }}" class="btn btn-success">Edit</a>
          </td>
          @if ($question->trashed())
            <td>
              <form action="{{ route('admins.questions.restore', ['question' => $question->id]) }}" method="POST">
                @csrf
                <input type="submit" value="Restore" class="btn btn-warning">
              </form>
            </td>
            <td>
              <form action="{{ route('admins.questions.force-delete', ['question' => $question->id]) }}" method="POST">
                @csrf
                <input type="submit" value="Delete Permanently" class="btn btn-danger" 
                  onclick='return confirm("Are you sure you want to delete question by id {{ $question->id }} permanently? This action can not be undone!")''>
              </form>
            </td>
          @else
            <td></td>
            <td>
              <form action="{{ route('admins.questions.destroy', ['question' => $question->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" value="Delete" class="btn btn-danger" onclick='return confirm("Are you sure you want to delete question by id {{ $question->id }}?")'>
              </form>
            </td>
          @endif
        </tr>
      @endforeach
    </tbody>
  </table>
@else
  <p>There are no questions!</p>
@endif