<x-app-layout>

    <x-slot name="header">
        Edit Department
    </x-slot>

    <x-crud.form-page
        title="Edit Department"
        description="Update department information."
    >

        <x-crud.form-card>

            <form
                method="POST"
                action="{{ route('admin.departments.update', $department) }}"
                x-data="{ loading: false }"
                x-on:submit="loading = true"
            >

                @csrf
                @method('PUT')

                <x-forms.field
                    label="Department Code"
                    for="code"
                    :error="$errors->get('code')"
                >

                    <x-forms.text-input
                        id="code"
                        name="code"
                        type="text"
                        class="block w-full"
                        :value="old('code', $department->code)"
                        placeholder="TI"
                        required
                        autofocus
                    />

                </x-forms.field>


                <x-forms.field
                    label="Department Name"
                    for="name"
                    :error="$errors->get('name')"
                    class="mt-4"
                >

                    <x-forms.text-input
                        id="name"
                        name="name"
                        type="text"
                        class="block w-full"
                        :value="old('name', $department->name)"
                        placeholder="Teknik Informatika"
                        required
                    />

                </x-forms.field>


                <x-forms.field
                    label="Description"
                    for="description"
                    :error="$errors->get('description')"
                    class="mt-4"
                >

                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    >{{ old('description', $department->description) }}</textarea>

                </x-forms.field>


                <x-forms.field
                    label="Status"
                    for="is_active"
                    :error="$errors->get('is_active')"
                    class="mt-6"
                >

                    <x-forms.select
                        id="is_active"
                        name="is_active"
                        class="block w-full"
                        required
                    >

                        <option
                            value="1"
                            {{ old('is_active', $department->is_active) ? 'selected' : '' }}
                        >
                            Active
                        </option>

                        <option
                            value="0"
                            {{ ! old('is_active', $department->is_active) ? 'selected' : '' }}
                        >
                            Inactive
                        </option>

                    </x-forms.select>

                </x-forms.field>


                <x-crud.form-actions>

                    <x-buttons.primary>
                        Save Department
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
