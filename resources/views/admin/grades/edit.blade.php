<x-app-layout>

    <x-slot name="header">
        Edit Grade
    </x-slot>

    <x-crud.form-page
        title="Edit Grade"
        description="Update grade information."
    >

        <x-crud.form-card>

            <form
                method="POST"
                action="{{ route('admin.grades.update', $grade) }}"
                x-data="{ loading: false }"
                x-on:submit="loading = true"
            >

                @csrf
                @method('PUT')

                <x-forms.field
                    label="Grade Code"
                    for="code"
                    :error="$errors->get('code')"
                >

                    <x-forms.text-input
                        id="code"
                        name="code"
                        type="text"
                        class="block w-full"
                        :value="old('code', $grade->code)"
                        required
                    />

                </x-forms.field>

                <x-forms.field
                    label="Grade Name"
                    for="name"
                    :error="$errors->get('name')"
                    class="mt-4"
                >

                    <x-forms.text-input
                        id="name"
                        name="name"
                        type="text"
                        class="block w-full"
                        :value="old('name', $grade->name)"
                        required
                    />

                </x-forms.field>

                <div class="grid grid-cols-2 gap-4 mt-4">

                    <x-forms.field
                        label="Minimum Score"
                        for="minimum_score"
                        :error="$errors->get('minimum_score')"
                    >

                        <x-forms.text-input
                            id="minimum_score"
                            name="minimum_score"
                            type="number"
                            min="0"
                            max="100"
                            class="block w-full"
                            :value="old('minimum_score', $grade->minimum_score)"
                            required
                        />

                    </x-forms.field>

                    <x-forms.field
                        label="Maximum Score"
                        for="maximum_score"
                        :error="$errors->get('maximum_score')"
                    >

                        <x-forms.text-input
                            id="maximum_score"
                            name="maximum_score"
                            type="number"
                            min="0"
                            max="100"
                            class="block w-full"
                            :value="old('maximum_score', $grade->maximum_score)"
                            required
                        />

                    </x-forms.field>

                </div>

                <x-forms.field
                    label="Grade Point"
                    for="grade_point"
                    :error="$errors->get('grade_point')"
                    class="mt-4"
                >

                    <x-forms.text-input
                        id="grade_point"
                        name="grade_point"
                        type="number"
                        step="0.01"
                        min="0"
                        max="4"
                        class="block w-full"
                        :value="old('grade_point', $grade->grade_point)"
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
                        rows="3"
                        class="block w-full"
                    >{{ old('description', $grade->description) }}</x-forms.textarea>

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
                            @selected(old('is_active', $grade->is_active) == 1)
                        >
                            Active
                        </option>

                        <option
                            value="0"
                            @selected(old('is_active', $grade->is_active) == 0)
                        >
                            Inactive
                        </option>

                    </x-forms.select>

                </x-forms.field>

                <x-crud.form-actions>

                    <x-buttons.primary>
                        Update Grade
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
