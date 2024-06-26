<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="{{ csrf_token() }}" name="csrf-token">

    <title>
        @isset($title)
            {{ $title !== null ? 'Devpicker - ' . $title : 'Devpicker' }}
        @else
            Devpicker
        @endisset
    </title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net" rel="preconnect">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @filamentStyles
    @vite('resources/css/app.css')

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($title))
            <header class="bg-white shadow">
                <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    {{ $title }}
                </div>
            </header>
        @endif

        <!-- Page Content -->


        <main class="p-4 mx-auto max-w-7xl">

            {{ $slot }}

        </main>

        <livewire:slide-over />
        <livewire:developer-notes-modal />

    </div>

    @stack('modals')

    @livewire('notifications')

    @filamentScripts
    @vite('resources/js/app.js')

    @livewireScripts
</body>

</html>
