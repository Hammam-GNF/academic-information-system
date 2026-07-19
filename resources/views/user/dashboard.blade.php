<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-layout.section>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-layout.card class="overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>

            </x-layout.card>

        </div>

    </x-layout.section>

</x-app-layout>
