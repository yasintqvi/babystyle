@if ($paginator->hasPages())
    <div class="card">
        <div class="card-inner">
            <div class="nk-block-between-md g-3">

                <nav class="d-flex justify-items-center w-100 justify-content-between">
                    <div class="d-flex justify-content-between flex-fill d-sm-none">
                        <ul class="pagination">
                            {{-- Previous Page Link --}}
                            @if ($paginator->onFirstPage())
                                <li class="page-item disabled" aria-disabled="true">
                                    <span class="page-link">صفحه قبل</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">صفحه
                                        قبل</a>
                                </li>
                            @endif

                            {{-- Next Page Link --}}
                            @if ($paginator->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">صفحه
                                        بعد</a>
                                </li>
                            @else
                                <li class="page-item disabled" aria-disabled="true">
                                    <span class="page-link">صفحه بعد</span>
                                </li>
                            @endif
                        </ul>
                    </div>

                    <div class="g">
                        <ul class="pagination">
                            {{-- Previous Page Link --}}
                            @if ($paginator->onFirstPage())
                                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                                    <span class="page-link" aria-hidden="true">&lsaquo;</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                                        aria-label="@lang('pagination.previous')">&lsaquo;</a>
                                </li>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($elements as $element)
                                {{-- "Three Dots" Separator --}}
                                @if (is_string($element))
                                    <li class="page-item disabled" aria-disabled="true"><span
                                            class="page-link">{{ $element }}</span></li>
                                @endif

                                {{-- Array Of Links --}}
                                @if (is_array($element))
                                    @foreach ($element as $page => $url)
                                        @if ($page == $paginator->currentPage())
                                            <li class="page-item active" aria-current="page"><span
                                                    class="page-link">{{ $page }}</span></li>
                                        @else
                                            <li class="page-item"><a class="page-link"
                                                    href="{{ $url }}">{{ $page }}</a></li>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($paginator->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"
                                        aria-label="@lang('pagination.next')">&rsaquo;</a>
                                </li>
                            @else
                                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                                    <span class="page-link" aria-hidden="true">&rsaquo;</span>
                                </li>
                            @endif
                        </ul>
                    </div>

                    <div class="d-none d-sm-flex align-items-sm-center justify-content-sm-between">
                        <div class="g">
                            <p class="small text-muted">
                                نمایش
                                <span class="fw-semibold">{{ $paginator->firstItem() }}</span>
                                تا
                                <span class="fw-semibold">{{ $paginator->lastItem() }}</span>
                                از
                                <span class="fw-semibold">{{ $paginator->total() }}</span>
                                نتیجه
                            </p>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
@endif
