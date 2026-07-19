<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Change Password for {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form
                        method="POST"
                        action="{{ route('admin.users.update-password', $user) }}"
                        x-data="{ loading: false }"
                        x-on:submit="loading = true"
                    >
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <x-forms.input-label for="password" value="New Password" />

                            <x-forms.text-input
                                id="password"
                                name="password"
                                type="password"
                                class="mt-1 block w-full"
                                required
                            />

                            <x-feedback.input-error
                                :messages="$errors->get('password')"
                                class="mt-2"
                            />
                        </div>

                        <div class="mb-4">
                            <x-forms.input-label for="password_confirmation" value="Confirm New Password" />

                            <x-forms.text-input
                                id="password_confirmation"
                                name="password_confirmation"
                                type="password"
                                class="mt-1 block w-full"
                                required
                            />

                            <x-feedback.input-error
                                :messages="$errors->get('password_confirmation')"
                                class="mt-2"
                            />
                        </div>

                        <div class="flex justify-end">
                            <x-buttons.primary>
                                Update Password
                            </x-buttons.primary>

                            <x-buttons.secondary class="ms-3" onclick="window.history.back();">
                                Cancel
                            </x-buttons.secondary>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
