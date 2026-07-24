<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<x-layout.head />

<body
    x-data="{ sidebarOpen: false }"
    @keydown.escape.window="sidebarOpen = false"
    class="bg-gray-100 font-sans antialiased"
>

    <x-feedback.toast />

    {{-- Mobile Sidebar Overlay --}}
    <div
        x-show="sidebarOpen"
        x-transition.opacity
        x-cloak
        @click="sidebarOpen = false"
        class="fixed inset-0 z-40 bg-black/50 lg:hidden"
    ></div>

    <div class="flex min-h-screen">

        {{-- Sidebar --}}
        @include('layouts.partials.sidebar')

        <div class="flex min-w-0 flex-1 flex-col">

            {{-- Topbar --}}
            @include('layouts.partials.topbar')

            {{-- Main Content --}}
            <main class="flex-1 overflow-auto p-6">

                {{ $slot }}

            </main>

        </div>

    </div>

    {{-- Global Modals --}}
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
