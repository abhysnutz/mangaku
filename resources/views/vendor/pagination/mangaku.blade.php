@if ($paginator->hasPages())
    <div class="pagination">
        @foreach ($elements as $element)
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a class="active" href="./" disabled="">{{ $page }}</a>
                    @else
                        <a class="n_active" href="{{ $url }}">{{ $page }}</a>    
                    @endif
                @endforeach
            @endif
        @endforeach
    </div>
@endif