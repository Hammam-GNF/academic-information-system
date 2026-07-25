@if ($student->photo)

    <img
        src="{{ Storage::url($student->photo) }}"
        alt="{{ $student->name }}"
        class="h-11 w-11 rounded-full object-cover ring-2 ring-gray-200"
    >

@else

    <div
        class="flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 ring-2 ring-gray-200"
    >

        <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-6 w-6 text-gray-400"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
        >

            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="1.5"
                d="M16 7a4 4 0 11-8 0 4 4 0 018 0Zm-8 10a6 6 0 0112 0H8Z"
            />

        </svg>

    </div>

@endif
