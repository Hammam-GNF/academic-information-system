@if (session()->has('import_errors'))

    <x-feedback.alert
        type="warning"
        dismissible
        class="mb-6"
    >

        <x-slot:title>

            Import Completed with Errors

        </x-slot:title>

        <p class="mb-3">

            Some rows could not be imported.

        </p>

        <ul class="list-disc space-y-1 pl-5">

            @foreach (session('import_errors') as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </x-feedback.alert>

@endif
