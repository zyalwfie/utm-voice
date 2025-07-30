@props(['ariaCurrent' => false, 'href', 'current' => false])

@if ($current)
    @php
        $classes =
            'flex items-center p-2 text-base font-medium text-gray-600 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group bg-gray-100';
        $arriaCurrent = 'page';
    @endphp
@else
    @php
        $classes =
            'flex items-center p-2 text-base font-medium text-gray-500 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group';
    @endphp
@endif

<li>
    <a href="{{ $href }}" class="{{ $classes }}" aria-current="{{ $ariaCurrent }}">
        {{ $icon }}
        <span class="ml-3">{{ $slot }}</span>
    </a>
</li>
