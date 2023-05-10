@if ($paginator->hasPages())
    <nav class="navigation pagination d-inline-block">
        <div class="nav-links">
            @if ($paginator->onFirstPage())
                <a class="prev page-numbers disabled" href="#">قبل</a>
            @else
                <a class="prev page-numbers" href="{{ $paginator->previousPageUrl() }}">قبل</a>
            @endif

            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <a class="disabled" aria-disabled="true"><span>{{ $element }}</span></a>

                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                                <span aria-current="page" class="page-numbers current">{{ $page }}</span>
                        @else
                            <a class="page-numbers" href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                    <a class="next page-numbers" href="{{ $paginator->nextPageUrl() }}">بعد</a>
            @else
                <a class="next page-numbers disabled" href="#">بعد</a>
            @endif
        </div>
    </nav>

@endif
