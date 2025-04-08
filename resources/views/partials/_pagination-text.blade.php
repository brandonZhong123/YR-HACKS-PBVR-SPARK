@props(['paginator'])
<div class="mx-auto hidden font-semibold md:block">
    @if ($paginator->count() > 0)
        Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }} results
    @endif
</div>