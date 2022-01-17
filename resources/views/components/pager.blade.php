@if ($items->total() > 0)
  <div class="d-flex justify-content-center">
    {{ $items->onEachSide(1)->links() }}
  </div>
  <div class="d-flex justify-content-center">
    <p>Showing {{ $items->firstItem() }} to {{ $items->lastItem() }} of {{ $items->total() }} results</p>
  </div>
@endif