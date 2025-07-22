@props(['currentPage'])

<li>
    <a href="{{ $href }}"
        class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ $currentPage ? 'bg-gray-300' : '' }}">
        {{ $icon }}
        <span class="ml-3">{{ $slot }}</span>
    </a>
</li>
