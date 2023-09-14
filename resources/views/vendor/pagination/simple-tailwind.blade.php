@if ($paginator->hasPages())
<div class="hpage">
        {{-- Previous Page Link --}}
        @if (!$paginator->onFirstPage())
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="l" style="display: inline-block;">
                <i class="fa fa-chevron-left" aria-hidden="true"></i>  Previous
            </a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="r" style="display: inline-block;">
                Next  <i class="fa fa-chevron-right" aria-hidden="true"></i>
            </a>
        @endif
    </div>
@endif
