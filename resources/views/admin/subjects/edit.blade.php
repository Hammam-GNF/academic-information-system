<x-app-layout>

    <x-slot name="header">
        Edit Subject
    </x-slot>

    <x-crud.form-page
        title="Edit Subject"
        description="Update subject information."
    >

        <x-crud.form-card>

            <form
                method="POST"
                action="{{ route('admin.subjects.update', $subject) }}"
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

                        @foreach($departments as $department)

                            <option
                                value="{{ $department->id }}"
                                @selected(old('department_id', $subject->department_id) == $department->id)
                            >
                                {{ $department->name }}
                            </option>

                        @endforeach

                    </x-forms.select>

                </x-forms.field>


                <x-forms.field
                    label="Subject Code"
                    for="code"
                    :error="$errors->get('code')"
                    class="mt-4"
                >

                    <x-forms.text-input
                        id="code"
                        name="code"
                        type="text"
                        class="block w-full"
                        :value="old('code', $subject->code)"
                        required
                    />

                </x-forms.field>


                <x-forms.field
                    label="Subject Name"
                    for="name"
                    :error="$errors->get('name')"
                    class="mt-4"
                >

                    <x-forms.text-input
                        id="name"
                        name="name"
                        type="text"
                        class="block w-full"
                        :value="old('name', $subject->name)"
                        required
                    />

                </x-forms.field>


                <x-forms.field
                    label="Credit Hours (SKS)"
                    for="credit_hours"
                    :error="$errors->get('credit_hours')"
                    class="mt-4"
                >

                    <x-forms.text-input
                        id="credit_hours"
                        name="credit_hours"
                        type="number"
                        min="1"
                        max="12"
                        class="block w-full"
                        :value="old('credit_hours', $subject->credit_hours)"
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
                    >{{ old('description', $subject->description) }}</textarea>

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
                            {{ old('is_active', $subject->is_active) ? 'selected' : '' }}
                        >
                            Active
                        </option>

                        <option
                            value="0"
                            {{ !old('is_active', $subject->is_active) ? 'selected' : '' }}
                        >
                            Inactive
                        </option>

                    </x-forms.select>

                </x-forms.field>


                <x-crud.form-actions>

                    <x-buttons.primary>
                        Save Subject
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
