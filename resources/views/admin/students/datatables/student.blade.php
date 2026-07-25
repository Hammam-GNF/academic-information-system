<div class="flex items-center gap-3">

    @if ($student->photo)

        <img
            src="{{ Storage::url($student->photo) }}"
            alt="{{ $student->name }}"
            class="h-11 w-11 rounded-full object-cover ring-2 ring-gray-200"
        >

    @else

        <div
            class="flex h-11 w-11 items-center justify-center rounded-full bg-indigo-100 text-sm font-semibold text-indigo-700 ring-2 ring-indigo-200"
        >
            {{ Str::of($student->name)
                ->explode(' ')
                ->take(2)
                ->map(fn ($word) => Str::substr($word, 0, 1))
                ->join('') }}
        </div>

    @endif

    <div class="min-w-0">

        <div class="truncate font-semibold text-gray-900">

            {{ $student->name }}

        </div>

        <div class="text-xs text-gray-500">

            {{ $student->student_number }}

            @if ($student->nisn)

                • NISN {{ $student->nisn }}

            @endif

        </div>

    </div>

</div>
