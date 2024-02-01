<!-- resources/views/pagination.blade.php -->

<ul class="pagination">
    @if ($paginator->onFirstPage())
        <li class="page-item disabled " aria-disabled="true" aria-label="@lang('pagination.previous')">
            <span class="page-link SwitchColorBack " aria-hidden="true">&laquo;</span>
        </li>
    @else
        <li class="page-item">
            <a class="page-link SwitchColorBack " href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&laquo;</a>
        </li>
    @endif

    @foreach ($elements as $element)
        {{-- Handle array of links --}}
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="page-item " aria-current="page"><span class="page-link SwitchColor ">{{ $page }}</span></li>
                @else
                    <li class="page-item "><a class="page-link SwitchColor" href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach
        @endif
    @endforeach

    @if ($paginator->hasMorePages())
        <li class="page-item">
            <a class="page-link SwitchColorBack " href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&raquo;</a>
        </li>
    @else
        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
            <span class="page-link SwitchColorBack " aria-hidden="true">&raquo;</span>
        </li>
    @endif
</ul>
