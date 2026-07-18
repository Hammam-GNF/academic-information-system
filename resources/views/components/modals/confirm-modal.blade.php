@props([
    'name',
    'title',
    'message',
    'method' => 'DELETE',
    'submitText' => 'Confirm',
])

<x-modal :name="$name" focusable>
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
            <x-secondary-button
                type="button"
                x-on:click="$dispatch('close')"
            >
                Cancel
            </x-secondary-button>

            <x-danger-button>
                {{ $submitText }}
            </x-danger-button>
        </div>
    </form>
</x-modal>