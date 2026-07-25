@props([
    'photo' => null,
])

<x-forms.field
    label="Student Photo"
    for="photo"
    :error="$errors->get('photo')"
>

    <div
        x-data="{
            preview: @js($photo),

            change(event) {

                const file = event.target.files[0];

                if (
                    this.preview &&
                    this.preview.startsWith('blob:')
                ) {
                    URL.revokeObjectURL(this.preview);
                }

                if (! file) {

                    this.preview = @js($photo);

                    return;

                }

                this.preview = URL.createObjectURL(file);

            }
        }"
    >

        <label
            for="photo"
            class="flex cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 p-6 transition hover:border-indigo-500 hover:bg-indigo-50"
        >

            <template x-if="preview">

                <img
                    :src="preview"
                    alt="Student Photo Preview"
                    class="mb-4 h-40 w-40 rounded-lg border object-cover shadow-sm"
                >

            </template>

            <template x-if="! preview">

                <div
                    class="mb-4 flex h-40 w-40 items-center justify-center rounded-lg border bg-white"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-16 w-16 text-gray-400"
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

            </template>

            <span class="text-sm font-medium text-gray-700">
                Click to upload student photo
            </span>

            <span class="mt-1 text-xs text-gray-500">
                JPG, PNG or WEBP (Maximum 2 MB)
            </span>

        </label>

        <input
            id="photo"
            name="photo"
            type="file"
            class="hidden"
            accept="image/jpeg,image/png,image/webp"
            @change="change($event)"
        />

    </div>

</x-forms.field>
