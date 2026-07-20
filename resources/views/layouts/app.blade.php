<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<x-layout.head />

<body class="font-sans antialiased">

    <div class="min-h-screen bg-gray-100" x-data>

        @include('layouts.navigation')

        <x-feedback.toast />

        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <main>
            {{ $slot }}
        </main>

    </div>

    <x-modals.confirm-modal
        name="confirm-logout"
        title="Log Out"
        message="Are you sure you want to log out from your account?"
        method="POST"
        submit-text="Log Out"
    />

    <x-layout.scripts />

</body>

</html>
