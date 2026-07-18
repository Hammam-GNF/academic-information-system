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

                    <x-forms.field
                        label="Name"
                        for="name"
                        :error="$errors->get('name')"
                    >
                        <x-forms.text-input
                            id="name"
                            name="name"
                            type="text"
                            class="block w-full"
                            :value="old('name', $user->name)"
                            required
                            autofocus
                        />
                    </x-forms.field>

                    <x-forms.field
                        label="Email"
                        for="email"
                        :error="$errors->get('email')"
                        class="mt-4"
                    >
                        <x-forms.text-input
                            id="email"
                            name="email"
                            type="email"
                            class="block w-full"
                            :value="old('email', $user->email)"
                            required
                        />
                    </x-forms.field>

                    <x-forms.field
                        label="Role"
                        for="role"
                        :error="$errors->get('role')"
                        class="mt-6"
                    >
                        <x-forms.select
                            id="role"
                            name="role"
                            class="block w-full"
                            required
                        >
                            <option value="admin" {{ $user->hasRole('admin') ? 'selected' : '' }}>
                                Admin
                            </option>

                            <option value="user" {{ $user->hasRole('user') ? 'selected' : '' }}>
                                User
                            </option>
                        </x-forms.select>
                    </x-forms.field>

                    <div class="flex justify-end mt-6">
                        <x-buttons.primary>
                            Save User
                        </x-buttons.primary>

                        <x-buttons.secondary
                            class="ms-3"
                            onclick="window.history.back();"
                        >
                            Cancel
                        </x-buttons.secondary>
                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>
