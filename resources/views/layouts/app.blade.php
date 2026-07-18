<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<x-layout.head />

<body class="font-sans antialiased">

    <x-layout.page-container>

        {{ $slot }}

    </x-layout.page-container>

    <x-layout.scripts />

</body>

</html>
