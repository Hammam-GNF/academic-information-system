<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<x-layout.head />

<body class="font-sans antialiased">

    <div class="min-h-screen bg-gray-100">

        @include('layouts.navigation')

        <main class="min-h-screen">
            {{ $slot }}
        </main>

    </div>

    <x-layout.scripts />

</body>

</html>
