@props(['href', 'current' => false, 'arriaCurrent' => false])

@if ($current)
    @php
        $classes =
            'text-white bg-blue-700 rounded-sm md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500';
        $arriaCurrent = 'page';
    @endphp
@else
    @php
        $classes =
            'text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent';
    @endphp
@endif

<li>
    <a href="{{ $href }}"
        {{ $attributes->merge(['class' => 'block py-2 px-3 ' . $classes, 'arria-current' => $arriaCurrent]) }}>
        {{ $slot }}
    </a>
</li>
