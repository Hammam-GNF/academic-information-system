<x-app-layout>
    <x-slot name="header">
        Media Library
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-layout.card>

                <form
                    x-data="{ loading: false }"
                    @submit="loading = true"
                    action="{{ route('admin.media.store') }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="p-6 bg-white border-b border-gray-200 mb-4"
                >
                    @csrf

                    <input
                        type="file"
                        name="file"
                        required
                        class="mb-4 border rounded p-2"
                    >

                    <x-buttons.primary>
                        Upload
                    </x-buttons.primary>
                </form>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    @foreach($media as $item)
                        <div class="border rounded p-4">
                            <p class="text-sm text-gray-500">{{ $item->file_name }}</p>
                            @if(str_starts_with($item->mime_type, 'image/'))
                                <img
                                    src="{{ $item->getUrl() }}"
                                    alt=""
                                    class="w-full h-40 object-cover rounded mb-2"
                                >
                            @endif
                            <a href="{{ $item->getUrl() }}" target="_blank" class="text-blue-500 hover:underline">View File</a>
                            <button
                                type="button"
                                data-url="{{ route('admin.media.destroy', $item) }}"
                                class="delete-media-btn bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded"
                            >
                                Delete
                            </button>
                        </div>
                    @endforeach

                </div>

            </x-layout.card>

        </div>
    </div>

    <x-modals.confirm-modal
        name="confirm-delete-media"
        title="Delete Media"
        message="Are you sure you want to delete this media?"
        method="DELETE"
        submit-text="Delete"
    />

    @push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).on('click', '.delete-media-btn', function () {

            let action = $(this).data('url');

            $('#confirm-delete-media-form').attr('action', action);

            window.dispatchEvent(
                new CustomEvent('open-modal', {
                    detail: 'confirm-delete-media'
                })
            );
        });
    </script>
    @endpush
</x-app-layout>
