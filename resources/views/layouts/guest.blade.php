<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<x-layout.head />

<body class="font-sans antialiased">

<x-feedback.toast />

<div class="auth-layout">

    <div class="auth-container">

        <div class="auth-logo">

            <a href="/">

                <x-branding.application-logo
                    class="w-20 h-20 text-gray-800"
                />

            </a>

        </div>

        @isset($title)

            <div class="mb-6 text-center">

                <h1 class="text-2xl font-bold text-gray-900">

                    {{ $title }}

                </h1>

                @isset($description)

                    <p class="mt-2 text-sm text-gray-500">

                        {{ $description }}

                    </p>

                @endisset

            </div>

        @endisset

        <div class="auth-card">

            {{ $slot }}

        </div>

    </div>

</div>

<x-layout.scripts />

</body>

</html>
