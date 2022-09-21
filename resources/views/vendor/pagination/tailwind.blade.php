@if ($paginator->hasPages())
    <div class="pagination flx">
        @if ($paginator->onFirstPage())
            <a href="javascript:void(0)" class="text"><i class="far fa-chevron-left"></i> Prejšnja stran</a>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="text"><i class="far fa-chevron-left"></i> Prejšnja stran</a>
        @endif
        @foreach ($elements as $element)
            @if (is_string($element))
                <a href="javascript:void(0)">
                    <span aria-disabled="true">
                        <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 cursor-default leading-5">{{ $element }}</span>
                    </span>
                </a>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    <a href="{{ $url }}" class="{{ $page == $paginator->currentPage() ? 'active bgt' : '' }}">
                        {{ $page }}
                    </a>
                @endforeach
            @endif
        @endforeach
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="text">Naslednja stran <i class="far fa-chevron-right"></i></a>
        @else
            <a href="javascript:void(0)" class="text">Naslednja stran <i class="far fa-chevron-right"></i></a>
        @endif
    </div>
@endif
