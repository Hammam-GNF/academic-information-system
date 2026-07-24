<x-app-layout>

    <x-slot name="header">
        Create Grade
    </x-slot>

    <x-crud.form-page
        title="Create Grade"
        description="Create a new grade."
    >

        <x-crud.form-card>

            <form
                method="POST"
                action="{{ route('admin.grades.store') }}"
                x-data="{ loading: false }"
                x-on:submit="loading = true"
            >

                @csrf

                <x-forms.field
                    label="Code"
                    for="code"
                    :error="$errors->get('code')"
                >

                    <x-forms.text-input
                        id="code"
                        name="code"
                        type="text"
                        class="block w-full"
                        :value="old('code')"
                        required
                    />

                </x-forms.field>

                <x-forms.field
                    label="Name"
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

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

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
                            :value="old('minimum_score')"
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
                            :value="old('maximum_score')"
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
                        :value="old('grade_point')"
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
                        required
                    >

                        <option
                            value="1"
                            @selected(old('is_active') == '1')
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
                        Save Grade
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
