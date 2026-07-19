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

            {{-- navigation next commit --}}

        </div>

    </aside>

    <div class="flex flex-col flex-1">

        {{-- Topbar --}}
        <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-end px-6">

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
