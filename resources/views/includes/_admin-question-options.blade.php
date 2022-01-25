<div class="d-flex">
  <a href="{{ route('admins.questions.edit', ['question' => $question->id]) }}" class="btn btn-success me-2">Edit</a>
  @if ($question->trashed())
    <form action="{{ route('admins.questions.restore', ['question' => $question->id]) }}" method="POST" class="me-2">
      @csrf
      <input type="submit" value="Restore" class="btn btn-warning">
    </form>
    <form action="{{ route('admins.questions.force-delete', ['question' => $question->id]) }}" method="POST" class="me-2">
      @csrf
      <input type="submit" value="Delete Permanently" class="btn btn-danger" 
        onclick="return confirm('Are you sure you want to delete question by id {{ $question->id }} permanently? This action can not be undone!')">
    </form>
  @else
    <form action="{{ route('admins.questions.destroy', ['question' => $question->id]) }}" method="POST" class="me-2">
      @csrf
      @method('DELETE')
      <input type="submit" value="Delete" class="btn btn-danger" onclick='return confirm("Are you sure you want to delete question by id {{ $question->id }}?")'>
    </form>
  @endif
</div>