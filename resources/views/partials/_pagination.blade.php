@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-center mt-4">
        @if ($paginator->onFirstPage())
            <span class="px-3 py-1 mx-1 bg-gray-200 text-gray-700 rounded cursor-not-allowed">Previous</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-1 mx-1 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Previous</a>
        @endif

        @foreach ($paginator->links()->elements as $element)
            @if (is_string($element))
                <span class="px-3 py-1 mx-1 text-gray-700">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-3 py-1 mx-1 bg-blue-500 text-white rounded">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="px-3 py-1 mx-1 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-1 mx-1 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Next</a>
        @else
            <span class="px-3 py-1 mx-1 bg-gray-200 text-gray-700 rounded cursor-not-allowed">Next</span>
        @endif
    </nav>
@endif