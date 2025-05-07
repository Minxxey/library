<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        @livewireStyles
    </head>
    <body class="min-h-screen dark:bg-zinc-800">
    @include('partials.navbar')
        {{ $slot }}
        @fluxScripts
        @livewireScripts
    </body>
</html>
