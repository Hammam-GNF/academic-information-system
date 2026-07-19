<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<x-layout.head />

<body class="font-sans antialiased bg-gray-100">

<div class="flex min-h-screen">

    {{-- Sidebar --}}
    <aside class="hidden lg:flex lg:w-64 lg:flex-col bg-white border-r border-gray-200">

        <div class="flex items-center h-16 px-6 border-b">

            <a
                href="{{ route('admin.dashboard') }}"
                class="flex items-center gap-3"
            >
                <x-branding.application-logo class="w-8 h-8 text-gray-800"/>

                <span class="font-bold text-lg text-gray-900">
                    Laravel Template
                </span>

            </a>

        </div>

        <div class="flex-1 px-4 py-6">

            <p
                class="px-3 mb-3 text-xs font-semibold tracking-wider uppercase text-gray-400"
            >
                Main Menu
            </p>

            <nav class="space-y-1">

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="{{ request()->routeIs('admin.dashboard')
                        ? 'bg-indigo-50 text-indigo-700 font-semibold'
                        : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900'
                    }} flex items-center rounded-lg px-3 py-2 transition"
                >
                    Dashboard
                </a>

                <a
                    href="{{ route('admin.users.index') }}"
                    class="{{ request()->routeIs('admin.users.*')
                        ? 'bg-indigo-50 text-indigo-700 font-semibold'
                        : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900'
                    }} flex items-center rounded-lg px-3 py-2 transition"
                >
                    Users
                </a>

                <a
                    href="{{ route('admin.activity-logs.index') }}"
                    class="{{ request()->routeIs('admin.activity-logs.*')
                        ? 'bg-indigo-50 text-indigo-700 font-semibold'
                        : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900'
                    }} flex items-center rounded-lg px-3 py-2 transition"
                >
                    Activity Logs
                </a>

                <a
                    href="{{ route('admin.settings.index') }}"
                    class="{{ request()->routeIs('admin.settings.*')
                        ? 'bg-indigo-50 text-indigo-700 font-semibold'
                        : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900'
                    }} flex items-center rounded-lg px-3 py-2 transition"
                >
                    Settings
                </a>

                <a
                    href="{{ route('admin.media.index') }}"
                    class="{{ request()->routeIs('admin.media.*')
                        ? 'bg-indigo-50 text-indigo-700 font-semibold'
                        : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900'
                    }} flex items-center rounded-lg px-3 py-2 transition"
                >
                    Media Library
                </a>

            </nav>

        </div>

    </aside>

    <div class="flex flex-col flex-1">

        {{-- Topbar --}}
        <header
            class="flex items-center justify-between h-16 px-6 bg-white border-b border-gray-200"
        >

            <h1
                class="text-lg font-semibold text-gray-900"
            >
                {{ $header ?? '' }}
            </h1>

            <x-navigation.dropdown>

                <x-slot name="trigger">

                    <button
                        class="flex items-center gap-3"
                    >

                        @if(Auth::user()->hasMedia('avatar'))

                            <img
                                src="{{ Auth::user()->getFirstMediaUrl('avatar') }}"
                                class="w-9 h-9 rounded-full object-cover"
                            >

                        @else

                            <div class="w-9 h-9 rounded-full bg-gray-300 flex items-center justify-center">

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
                            onclick="event.preventDefault();this.closest('form').submit();"
                        >
                            Logout
                        </x-navigation.dropdown-link>

                    </form>

                </x-slot>

            </x-navigation.dropdown>

        </header>

        <main class="flex-1 p-6">

            {{ $slot }}

        </main>

    </div>

</div>

<x-layout.scripts />

</body>

</html>
