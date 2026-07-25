@props([
    'action',
    'method' => 'POST',
    'student' => null,
    'classrooms',
])

<form
    method="POST"
    action="{{ $action }}"
    enctype="multipart/form-data"
    x-data="{ loading: false }"
    x-on:submit="loading = true"
>

    @csrf

    @if ($method !== 'POST')
        @method($method)
    @endif

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">

        {{-- ========================= --}}
        {{-- Left Column --}}
        {{-- ========================= --}}

        <div>

            <x-students.photo-upload
                :photo="$student?->photo ? Storage::url($student->photo) : null"
            />

            <x-forms.field
                label="Student Number"
                for="student_number"
                :error="$errors->get('student_number')"
            >

                <x-forms.text-input
                    id="student_number"
                    name="student_number"
                    type="text"
                    class="block w-full"
                    :value="old('student_number', $student?->student_number)"
                    placeholder="Example: 20260001"
                    required
                    autofocus
                />

            </x-forms.field>

            <x-forms.field
                label="NISN"
                for="nisn"
                :error="$errors->get('nisn')"
                class="mt-4"
            >

                <x-forms.text-input
                    id="nisn"
                    name="nisn"
                    type="text"
                    class="block w-full"
                    :value="old('nisn', $student?->nisn)"
                    placeholder="Example: 0051234567"
                />

            </x-forms.field>

            <x-forms.field
                label="Student Name"
                for="name"
                :error="$errors->get('name')"
                class="mt-4"
            >

                <x-forms.text-input
                    id="name"
                    name="name"
                    type="text"
                    class="block w-full"
                    :value="old('name', $student?->name)"
                    placeholder="Enter student's full name"
                    required
                />

            </x-forms.field>

            <x-forms.field
                label="Classroom"
                for="classroom_id"
                :error="$errors->get('classroom_id')"
                class="mt-4"
            >

                <x-forms.select
                    id="classroom_id"
                    name="classroom_id"
                    class="block w-full"
                    required
                >

                    <option value="">
                        Select Classroom
                    </option>

                    @foreach ($classrooms as $classroom)

                        <option
                            value="{{ $classroom->id }}"
                            @selected(old('classroom_id', $student?->classroom_id) == $classroom->id)
                        >
                            {{ $classroom->grade->name }}
                            -
                            {{ $classroom->name }}
                        </option>

                    @endforeach

                </x-forms.select>

            </x-forms.field>

            <x-forms.field
                label="Gender"
                for="gender"
                :error="$errors->get('gender')"
                class="mt-4"
            >

                <x-forms.select
                    id="gender"
                    name="gender"
                    class="block w-full"
                    required
                >

                    <option value="">
                        Select Gender
                    </option>

                    <option
                        value="male"
                        @selected(old('gender', $student?->gender) === 'male')
                    >
                        Male
                    </option>

                    <option
                        value="female"
                        @selected(old('gender', $student?->gender) === 'female')
                    >
                        Female
                    </option>

                </x-forms.select>

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
                        @selected(old('is_active', $student?->is_active ?? true))
                    >
                        Active
                    </option>

                    <option
                        value="0"
                        @selected(old('is_active', $student?->is_active) == false)
                    >
                        Inactive
                    </option>

                </x-forms.select>

            </x-forms.field>

        </div>

        {{-- ========================= --}}
        {{-- Right Column --}}
        {{-- ========================= --}}

        <div>

            <x-forms.field
                label="Birth Place"
                for="birth_place"
                :error="$errors->get('birth_place')"
            >

                <x-forms.text-input
                    id="birth_place"
                    name="birth_place"
                    type="text"
                    class="block w-full"
                    :value="old('birth_place', $student?->birth_place)"
                    placeholder="Example: Jakarta"
                    required
                />

            </x-forms.field>

            <x-forms.field
                label="Birth Date"
                for="birth_date"
                :error="$errors->get('birth_date')"
                class="mt-4"
            >

                <x-forms.text-input
                    id="birth_date"
                    name="birth_date"
                    type="date"
                    class="block w-full"
                    :value="old(
                        'birth_date',
                        $student?->birth_date?->format('Y-m-d')
                    )"
                    required
                />

            </x-forms.field>

            <x-forms.field
                label="Phone Number"
                for="phone"
                :error="$errors->get('phone')"
                class="mt-4"
            >

                <x-forms.text-input
                    id="phone"
                    name="phone"
                    type="text"
                    class="block w-full"
                    :value="old('phone', $student?->phone)"
                    placeholder="Example: 081234567890"
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
                    :value="old('email', $student?->email)"
                    placeholder="Example: student@email.com"
                />

            </x-forms.field>

            <x-forms.field
                label="Address"
                for="address"
                :error="$errors->get('address')"
                class="mt-4"
            >

                <x-forms.textarea
                    id="address"
                    name="address"
                    class="block w-full"
                    rows="5"
                    placeholder="Enter student's home address"
                >{{ old('address', $student?->address) }}</x-forms.textarea>

            </x-forms.field>

        </div>

    </div>

    <x-crud.form-actions>

        <x-buttons.primary>
            {{ $student ? 'Update Student' : 'Save Student' }}
        </x-buttons.primary>

        <x-buttons.secondary
            type="button"
            onclick="window.history.back()"
        >
            Cancel
        </x-buttons.secondary>

    </x-crud.form-actions>

</form>
