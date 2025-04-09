@if ($paginator->hasPages())
    <nav class="text-center">
        <ul class="pagination pagination-area">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="prev page-numbers" aria-hidden="true"><i class="bx bx-left-arrow-alt"></i></span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="prev page-numbers" aria-label="@lang('pagination.previous')"><i class="bx bx-left-arrow-alt"></i></a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-numbers current" aria-current="page"><span>{{ $page }}</span></li>
                        @else
                            <li><a class="page-numbers" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" class="next page-numbers" rel="next" aria-label="@lang('pagination.next')"><i class="bx bx-right-arrow-alt"></i></a>
                </li>
            @else
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="next page-numbers" aria-hidden="true"><i class="bx bx-right-arrow-alt"></i></span>
                </li>
            @endif
        </ul>
    </nav>
@endif
