@if ($paginator->hasPages())
<nav class="blog-pagination justify-content-center d-flex">
    <ul class="pagination" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <a href="#" class="page-link" aria-label="@lang('pagination.previous')">
                    <span aria-hidden="true">
                        <span class="lnr lnr-chevron-left"></span>
                    </span>
                </a>
            </li>
        @else
            <li class="page-item">
                <a href="{{ $paginator->previousPageUrl() }}" class="page-link" aria-label="@lang('pagination.previous')">
                    <span aria-hidden="true">
                        <span class="lnr lnr-chevron-left"></span>
                    </span>
                </a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active" aria-current="page"><span class="page-link">0{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">0{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a href="{{ $paginator->nextPageUrl() }}" class="page-link" aria-label="@lang('pagination.next')">
                    <span aria-hidden="true">
                        <span class="lnr lnr-chevron-right"></span>
                    </span>
                </a>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <a href="{{ $paginator->nextPageUrl() }}" class="page-link" aria-label="@lang('pagination.next')">
                    <span aria-hidden="true">
                        <span class="lnr lnr-chevron-right"></span>
                    </span>
                </a>
            </li>
        @endif
    </ul>
</nav>
@endif
