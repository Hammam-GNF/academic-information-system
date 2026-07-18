@props([
    'name',
    'title',
    'message',
    'method' => 'DELETE',
    'submitText' => 'Confirm',
])

<x-modals.modal :name="$name" focusable>
    <form
        id="{{ $name }}-form"
        method="POST"
        class="p-6"
    >
        @csrf
        @method($method)

        <h2 class="text-lg font-medium text-gray-900">
            {{ $title }}
        </h2>

        <p class="mt-2 text-sm text-gray-600">
            {{ $message }}
        </p>

        <div class="mt-6 flex justify-end gap-2">
            <x-buttons.secondary
                type="button"
                x-on:click="$dispatch('close')"
            >
                Cancel
            </x-buttons.secondary>

            <x-buttons.danger>
                {{ $submitText }}
            </x-buttons.danger>
        </div>
    </form>
</x-modals.modal>