<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<x-layout.head />

<body
    x-data="{ sidebarOpen: false }"
    @keydown.escape.window="sidebarOpen = false"
    class="font-sans antialiased bg-gray-100"
>

<x-feedback.toast />

<div
    x-show="sidebarOpen"
    x-transition.opacity
    x-cloak
    @click="sidebarOpen = false"
    class="fixed inset-0 z-40 bg-black/50 lg:hidden"
></div>

<div class="flex min-h-screen">

    <aside
        x-cloak
        class="fixed inset-y-0 left-0 z-50 flex w-64 -translate-x-full flex-col border-r border-gray-200 bg-white transform transition-transform duration-300 lg:static lg:translate-x-0"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    >

        <div class="flex h-16 items-center justify-between border-b px-6">

            <a
                href="{{ route('user.dashboard') }}"
                class="flex items-center gap-3"
            >
                <x-branding.application-logo class="h-8 w-8 text-gray-800"/>

                <span class="text-lg font-bold text-gray-900">
                    Laravel Template
                </span>

            </a>

            <button
                @click="sidebarOpen = false"
                class="text-gray-500 hover:text-gray-900 lg:hidden"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>
            </button>

        </div>

        <div class="flex-1 px-4 py-6">

            <p
                class="mb-3 px-3 text-xs font-semibold uppercase tracking-wider text-gray-400"
            >
                Main Menu
            </p>

            <nav class="space-y-1">

                <a
                    href="{{ route('user.dashboard') }}"
                    class="{{ request()->routeIs('user.dashboard')
                        ? 'bg-indigo-50 text-indigo-700 font-semibold'
                        : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900'
                    }} flex items-center rounded-lg px-3 py-2 transition"
                >
                    Dashboard
                </a>

            </nav>

        </div>

    </aside>

    <div class="flex flex-1 flex-col">

        <header
            class="flex h-16 items-center justify-between border-b border-gray-200 bg-white px-6"
        >

            <div class="flex items-center gap-4">

                <button
                    @click="sidebarOpen = true"
                    class="text-gray-600 hover:text-gray-900 lg:hidden"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"
                        />
                    </svg>
                </button>

                <h1 class="text-lg font-semibold text-gray-900">
                    {{ $header ?? '' }}
                </h1>

            </div>

            <x-navigation.dropdown>

                <x-slot name="trigger">

                    <button class="flex items-center gap-3">

                        @if(Auth::user()->hasMedia('avatar'))

                            <img
                                src="{{ Auth::user()->getFirstMediaUrl('avatar') }}"
                                class="h-9 w-9 rounded-full object-cover"
                            >

                        @else

                            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-gray-300">

                                {{ strtoupper(substr(Auth::user()->name,0,1)) }}

                            </div>

                        @endif

                        <span class="text-sm font-medium">

                            {{ Auth::user()->name }}

                        </span>

                    </button>

                </x-slot>

                <x-slot name="content">

                    <x-navigation.dropdown-link
                        :href="route('profile.edit')"
                    >
                        Profile
                    </x-navigation.dropdown-link>

                    <form
                        method="POST"
                        action="{{ route('logout') }}"
                    >
                        @csrf

                        <x-navigation.dropdown-link
                            :href="route('logout')"
                            onclick="
                                event.preventDefault();

                                document
                                    .getElementById('confirm-logout-form')
                                    .setAttribute(
                                        'action',
                                        '{{ route('logout') }}'
                                    );

                                window.dispatchEvent(
                                    new CustomEvent(
                                        'open-modal',
                                        {
                                            detail: 'confirm-logout'
                                        }
                                    )
                                );
                            "
                        >
                            Logout
                        </x-navigation.dropdown-link>

                    </form>

                </x-slot>

            </x-navigation.dropdown>

        </header>

        <main class="flex-1 overflow-auto p-6">

            {{ $slot }}

        </main>

    </div>

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
