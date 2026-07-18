<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit User
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm rounded-lg p-6">

                <form method="POST" action="{{ route('admin.users.update', $user) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <x-forms.input-label for="name" value="Name" />

                        <x-forms.text-input
                            id="name"
                            name="name"
                            type="text"
                            class="mt-1 block w-full"
                            :value="old('name', $user->name)"
                            required
                            autofocus
                        />

                        <x-feedback.input-error
                            :messages="$errors->get('name')"
                            class="mt-2"
                        />
                    </div>

                    <div class="mb-4">
                        <x-forms.input-label for="email" value="Email" />

                        <x-forms.text-input
                            id="email"
                            name="email"
                            type="email"
                            class="mt-1 block w-full"
                            :value="old('email', $user->email)"
                            required
                        />

                        <x-feedback.input-error
                            :messages="$errors->get('email')"
                            class="mt-2"
                        />
                    </div>

                    <div class="mb-6">
                        <x-forms.input-label for="role" value="Role" />

                        <select
                            id="role"
                            name="role"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            required
                        >
                            <option value="admin" {{ $user->hasRole('admin') ? 'selected' : '' }}>Admin</option>
                            <option value="user" {{ $user->hasRole('user') ? 'selected' : '' }}>User</option>
                        </select>

                        <x-feedback.input-error
                            :messages="$errors->get('role')"
                            class="mt-2"
                        />
                    </div>

                    <div class="flex justify-end">
                        <x-buttons.primary>
                            Save User
                        </x-buttons.primary>

                        <x-buttons.secondary class="ms-3" onclick="window.history.back();">
                            Cancel
                        </x-buttons.secondary>
                    </div>
                </form>

            </div>

        </div>
    </div>
</x-app-layout>