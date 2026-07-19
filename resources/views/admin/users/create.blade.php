<x-app-layout>

    <x-slot name="header">
        Create User
    </x-slot>

    <x-crud.form-page
        title="Create User"
        description="Create a new application user."
    >

        <x-crud.form-card>

            <form
                method="POST"
                action="{{ route('admin.users.store') }}"
                x-data="{ loading: false }"
                x-on:submit="loading = true"
            >

                @csrf

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
                            :value="old('name')"
                            required
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
                            :value="old('email')"
                            required
                        />
                    </x-forms.field>

                    <x-forms.field
                        label="Password"
                        for="password"
                        :error="$errors->get('password')"
                        class="mt-4"
                    >
                        <x-forms.text-input
                            id="password"
                            name="password"
                            type="password"
                            class="block w-full"
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
                            <option value="">Select Role</option>

                            <option value="admin">
                                Admin
                            </option>

                            <option value="user">
                                User
                            </option>
                        </x-forms.select>
                    </x-forms.field>

                <x-crud.form-actions>

                    <x-buttons.primary>
                        Save User
                    </x-buttons.primary>

                    <x-buttons.secondary
                        type="button"
                        onclick="window.history.back()"
                    >
                        Cancel
                    </x-buttons.secondary>

                </x-crud.form-actions>

            </form>

        </x-crud.form-card>

    </x-crud.form-page>

</x-app-layout>
