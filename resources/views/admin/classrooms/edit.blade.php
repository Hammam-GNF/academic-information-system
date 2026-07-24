<x-app-layout>

    <x-slot name="header">
        Edit Classroom
    </x-slot>

    <x-crud.form-page
        title="Edit Classroom"
        description="Update classroom information."
    >

        <x-crud.form-card>

            <form
                method="POST"
                action="{{ route('admin.classrooms.update', $classroom) }}"
                x-data="{ loading: false }"
                x-on:submit="loading = true"
            >

                @csrf
                @method('PUT')

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

                        @foreach ($departments as $department)

                            <option
                                value="{{ $department->id }}"
                                @selected(old('department_id', $classroom->department_id) == $department->id)
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

                        @foreach ($grades as $grade)

                            <option
                                value="{{ $grade->id }}"
                                @selected(old('grade_id', $classroom->grade_id) == $grade->id)
                            >
                                {{ $grade->name }}
                            </option>

                        @endforeach

                    </x-forms.select>

                </x-forms.field>


                <x-forms.field
                    label="Classroom Code"
                    for="code"
                    :error="$errors->get('code')"
                    class="mt-4"
                >

                    <x-forms.text-input
                        id="code"
                        name="code"
                        type="text"
                        class="block w-full"
                        :value="old('code', $classroom->code)"
                        placeholder="XII-IPA-1"
                        required
                    />

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
                        :value="old('name', $classroom->name)"
                        placeholder="Class XII IPA 1"
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
                        class="block w-full"
                        :value="old('capacity', $classroom->capacity)"
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
                    >{{ old('description', $classroom->description) }}</textarea>

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
                            {{ old('is_active', $classroom->is_active) ? 'selected' : '' }}
                        >
                            Active
                        </option>

                        <option
                            value="0"
                            {{ ! old('is_active', $classroom->is_active) ? 'selected' : '' }}
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
