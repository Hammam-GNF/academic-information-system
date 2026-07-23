<x-app-layout>

    <x-slot name="header">
        Create Semester
    </x-slot>

    <x-crud.form-page
        title="Create Semester"
        description="Create a new academic semester."
    >

        <x-crud.form-card>

            <form
                method="POST"
                action="{{ route('admin.semesters.store') }}"
                x-data="{ loading: false }"
                x-on:submit="loading = true"
            >

                @csrf

                <x-forms.field
                    label="Academic Year"
                    for="academic_year_id"
                    :error="$errors->get('academic_year_id')"
                >

                    <x-forms.select
                        id="academic_year_id"
                        name="academic_year_id"
                        class="block w-full"
                        required
                    >

                        <option value="">
                            Select Academic Year
                        </option>

                        @foreach ($academicYears as $academicYear)

                            <option
                                value="{{ $academicYear->id }}"
                                @selected(old('academic_year_id') == $academicYear->id)
                            >
                                {{ $academicYear->name }}
                            </option>

                        @endforeach

                    </x-forms.select>

                </x-forms.field>

                <x-forms.field
                    label="Semester Name"
                    for="name"
                    :error="$errors->get('name')"
                    class="mt-4"
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
                    label="Status"
                    for="is_active"
                    :error="$errors->get('is_active')"
                    class="mt-4"
                >

                    <x-forms.select
                        id="is_active"
                        name="is_active"
                        class="block w-full"
                        required
                    >

                        <option
                            value="0"
                            @selected(old('is_active') == '0')
                        >
                            Inactive
                        </option>

                        <option
                            value="1"
                            @selected(old('is_active') == '1')
                        >
                            Active
                        </option>

                    </x-forms.select>

                </x-forms.field>

                <x-crud.form-actions>

                    <x-buttons.primary>
                        Save Semester
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
