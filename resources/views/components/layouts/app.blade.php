<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Page Title' }}</title>

    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/png">

    @stack('head')

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <x-header />

    <main>
        {{ $slot }}
    </main>

    <x-footer />

    @stack('foot')
</body>

</html>
