<header
    class="flex h-16 items-center justify-between border-b border-gray-200 bg-white px-6"
>

    <div class="flex items-center gap-4">

        {{-- Mobile Sidebar Toggle --}}
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

    {{-- User Dropdown --}}
    <x-navigation.dropdown>

        <x-slot name="trigger">

            <button
                class="flex items-center gap-3"
            >

                @if (Auth::user()->hasMedia('avatar'))

                    <img
                        src="{{ Auth::user()->getFirstMediaUrl('avatar') }}"
                        alt="{{ Auth::user()->name }}"
                        class="h-9 w-9 rounded-full object-cover"
                    >

                @else

                    <div
                        class="flex h-9 w-9 items-center justify-center rounded-full bg-gray-300 font-semibold text-gray-700"
                    >

                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}

                    </div>

                @endif

                <div class="hidden text-left sm:block">

                    <div class="text-sm font-medium text-gray-900">
                        {{ Auth::user()->name }}
                    </div>

                    @if (Auth::user()->roles->isNotEmpty())

                        <div class="text-xs text-gray-500">
                            {{ ucfirst(Auth::user()->roles->first()->name) }}
                        </div>

                    @endif

                </div>

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
