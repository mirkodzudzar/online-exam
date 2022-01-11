<a href="{{ route('admins.professions.edit', ['profession' => $profession->id]) }}" class="btn btn-success d-inline">Edit</a>
@if ($profession->trashed())
  <form action="{{ route('admins.professions.restore', ['profession' => $profession->id]) }}" method="POST" class="d-inline">
    @csrf
    <input type="submit" value="Restore" class="btn btn-warning">
  </form>
  <form action="{{ route('admins.professions.force-delete', ['profession' => $profession->id]) }}" method="POST" class="d-inline">
    @csrf
    <input type="submit" value="Delete Permanently" class="btn btn-danger" 
      onclick="return confirm('Are you sure you want to delete {{ $profession->title }} permanently? This action can not be undone!')">
  </form>
@else
  <form action="{{ route('admins.professions.destroy', ['profession' => $profession->id]) }}" method="POST" class="d-inline">
    @csrf
    @method('DELETE')
    <input type="submit" value="Delete" class="btn btn-danger" onclick='return confirm("Are you sure you want to delete {{ $profession->title }}?")'>
  </form>
@endif