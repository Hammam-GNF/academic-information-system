@props([
    'name',
    'title',
    'action',
])

<x-modals.modal
    :name="$name"
    focusable
>

    <form
        id="{{ $name }}-form"
        method="POST"
        action="{{ $action }}"
        enctype="multipart/form-data"
        class="p-6"
        x-data="{ loading: false }"
        x-on:submit="
            loading = true;
            $root.loading = true;
        "
    >

        @csrf

        <h2 class="text-lg font-semibold text-gray-900">
            {{ $title }}
        </h2>

        <p class="mt-2 text-sm text-gray-600">
            Upload an Excel (.xlsx or .xls) file to import student data.
        </p>

        @if ($errors->has('import'))

            <x-feedback.alert
                type="danger"
                class="mt-4"
            >

                <x-slot:title>
                    Import Failed
                </x-slot:title>

                <ul class="list-disc space-y-1 pl-5">

                    @foreach ($errors->get('import') as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </x-feedback.alert>

        @endif

        <div class="mt-3">

            <a
                href="{{ route('admin.students.import-template') }}"
                class="text-sm font-medium text-blue-600 hover:underline"
            >
                Download Import Template
            </a>

        </div>

        <div class="mt-6">

            <label
                for="import-file"
                class="mb-2 block text-sm font-medium text-gray-700"
            >
                Excel File
            </label>

            <input
                id="import-file"
                name="file"
                type="file"
                accept=".xlsx,.xls"
                required
                class="block w-full rounded-lg border border-gray-300 text-sm
                       file:mr-4
                       file:rounded-md
                       file:border-0
                       file:bg-gray-100
                       file:px-4
                       file:py-2
                       file:text-sm
                       file:font-medium
                       hover:file:bg-gray-200"
            >

        </div>

        <div class="mt-6 flex justify-end gap-2">

            <x-buttons.secondary
                type="button"
                x-on:click="$dispatch('close')"
            >
                Cancel
            </x-buttons.secondary>

            <x-buttons.primary>
                Import Students
            </x-buttons.primary>

        </div>

    </form>

</x-modals.modal>
