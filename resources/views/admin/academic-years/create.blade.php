<x-app-layout>

    <x-slot name="header">
        Create Academic Year
    </x-slot>

    <x-crud.form-page
        title="Create Academic Year"
        description="Create a new academic year."
    >

        <x-crud.form-card>

            <form
                method="POST"
                action="{{ route('admin.academic-years.store') }}"
                x-data="{ loading: false }"
                x-on:submit="loading = true"
            >

                @csrf

                <x-forms.field
                    label="Academic Year"
                    for="name"
                    :error="$errors->get('name')"
                >
                    <x-forms.text-input
                        id="name"
                        name="name"
                        type="text"
                        class="block w-full"
                        :value="old('name')"
                        placeholder="2026/2027"
                        required
                        autofocus
                    />
                </x-forms.field>

                <x-forms.field
                    label="Start Date"
                    for="start_date"
                    :error="$errors->get('start_date')"
                    class="mt-4"
                >
                    <x-forms.text-input
                        id="start_date"
                        name="start_date"
                        type="date"
                        class="block w-full"
                        :value="old('start_date')"
                        required
                    />
                </x-forms.field>

                <x-forms.field
                    label="End Date"
                    for="end_date"
                    :error="$errors->get('end_date')"
                    class="mt-4"
                >
                    <x-forms.text-input
                        id="end_date"
                        name="end_date"
                        type="date"
                        class="block w-full"
                        :value="old('end_date')"
                        required
                    />
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
                        <option value="0">
                            Inactive
                        </option>

                        <option
                            value="1"
                            {{ old('is_active') == 1 ? 'selected' : '' }}
                        >
                            Active
                        </option>
                    </x-forms.select>
                </x-forms.field>

                <x-crud.form-actions>

                    <x-buttons.primary>
                        Save Academic Year
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
