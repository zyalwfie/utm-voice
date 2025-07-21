@if ($paginator->hasPages())
    <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0"
        aria-label="Table navigation">
        <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
            Menampilkan
            @if ($paginator->firstItem())
                <span
                    class="font-semibold text-gray-900 dark:text-white">{{ $paginator->firstItem() }}-{{ $paginator->lastItem() }}</span>
            @else
                {{ $paginator->count() }}
            @endif
            dari
            <span class="font-semibold text-gray-900 dark:text-white">{{ $paginator->total() }}</span>
        </span>

        <ul class="inline-flex items-stretch -space-x-px">

            @if ($paginator->onFirstPage())
                <li>
                    <span
                        class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-700 bg-white rounded-l-lg border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        <span class="sr-only">{!! __('pagination.previous') !!}</span>
                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}"
                        class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        <span class="sr-only">{!! __('pagination.previous') !!}</span>
                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                </li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li>
                        <span aria-disabled="true"
                            class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">{{ $element }}</span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <span
                                    class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-blue-700 bg-blue-100 border border-gray-300">{{ $page }}</span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}"
                                    class="transition flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700"
                                    aria-label="{{ 'Go to page :page' . $page }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            <li>
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}"
                        class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                        aria-label="{{ __('pagination.next') }}">
                        <span class="sr-only">{{ __('pagination.next') }}</span>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                @else
                    <span
                        class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-700 bg-white rounded-r-lg border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        <span class="sr-only">{!! __('pagination.previous') !!}</span>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </span>
                @endif
            </li>
        </ul>
    </nav>
@endif
