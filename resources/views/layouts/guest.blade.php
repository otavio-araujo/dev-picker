<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="{{ csrf_token() }}" name="csrf-token">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net" rel="preconnect">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @filamentStyles
    @vite('resources/css/app.css')

    <!-- Styles -->
    @livewireStyles
</head>

<body>
    <div class="font-sans antialiased text-gray-900">
        {{ $slot }}
    </div>

    @filamentScripts
    @vite('resources/js/app.js')

    @livewireScripts
</body>

</html>
