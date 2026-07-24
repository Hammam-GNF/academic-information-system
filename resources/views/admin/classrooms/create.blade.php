<x-app-layout>

    <x-slot name="header">
        Create Classroom
    </x-slot>

    <x-crud.form-page
        title="Create Classroom"
        description="Create a new classroom."
    >

        <x-crud.form-card>

            <form
                method="POST"
                action="{{ route('admin.classrooms.store') }}"
                x-data="{ loading: false }"
                x-on:submit="loading = true"
            >

                @csrf

                <x-forms.field
                    label="Department"
                    for="department_id"
                    :error="$errors->get('department_id')"
                >

                    <x-forms.select
                        id="department_id"
                        name="department_id"
                        class="block w-full"
                        required
                    >

                        <option value="">
                            Select Department
                        </option>

                        @foreach ($departments as $department)

                            <option
                                value="{{ $department->id }}"
                                @selected(old('department_id') == $department->id)
                            >
                                {{ $department->name }}
                            </option>

                        @endforeach

                    </x-forms.select>

                </x-forms.field>

                <x-forms.field
                    label="Grade"
                    for="grade_id"
                    :error="$errors->get('grade_id')"
                    class="mt-4"
                >

                    <x-forms.select
                        id="grade_id"
                        name="grade_id"
                        class="block w-full"
                        required
                    >

                        <option value="">
                            Select Grade
                        </option>

                        @foreach ($grades as $grade)

                            <option
                                value="{{ $grade->id }}"
                                @selected(old('grade_id') == $grade->id)
                            >
                                {{ $grade->name }}
                            </option>

                        @endforeach

                    </x-forms.select>

                </x-forms.field>

                <x-forms.field
                    label="Classroom Name"
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
                    label="Capacity"
                    for="capacity"
                    :error="$errors->get('capacity')"
                    class="mt-4"
                >

                    <x-forms.text-input
                        id="capacity"
                        name="capacity"
                        type="number"
                        min="1"
                        max="100"
                        class="block w-full"
                        :value="old('capacity', 36)"
                        required
                    />

                </x-forms.field>

                <x-forms.field
                    label="Description"
                    for="description"
                    :error="$errors->get('description')"
                    class="mt-4"
                >

                    <x-forms.textarea
                        id="description"
                        name="description"
                        rows="4"
                        class="block w-full"
                    >{{ old('description') }}</x-forms.textarea>

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
                            value="1"
                            @selected(old('is_active', '1') == '1')
                        >
                            Active
                        </option>

                        <option
                            value="0"
                            @selected(old('is_active') == '0')
                        >
                            Inactive
                        </option>

                    </x-forms.select>

                </x-forms.field>

                <x-crud.form-actions>

                    <x-buttons.primary>
                        Save Classroom
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
