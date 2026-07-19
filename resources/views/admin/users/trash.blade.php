<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Deleted Users
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-6">

                <a
                    href="{{ route('admin.users.index') }}"
                    class="btn btn-secondary"
                >
                    Back
                </a>

            </div>

            <x-layout.card class="overflow-x-auto">

                <table id="trash-users-table" class="w-full">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Deleted At</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody></tbody>
                </table>

            </x-layout.card>

        </div>
    </div>

    @push('styles')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    @endpush

    <x-modals.confirm-modal
        name="confirm-restore-user"
        title="Restore User"
        message="Are you sure you want to restore this user?"
        method="PUT"
        submit-text="Restore"
    />

    <x-modals.confirm-modal
        name="confirm-force-delete"
        title="Force Delete User"
        message="This action cannot be undone."
        method="DELETE"
        submit-text="Delete"
    />

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
        <script>
            $(function () {
                $('#trash-users-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('admin.users.trash') }}",
                    columns: [
                        { data: 'name', name: 'name' },
                        { data: 'email', name: 'email' },
                        { data: 'role', name: 'role' },
                        { data: 'deleted_at', name: 'deleted_at' },
                        { data: 'action', name: 'action' },
                    ],
                });
            });

            $(document).on('click', '.restore-user-btn', function () {

                let action = $(this).data('url');

                $('#confirm-restore-user-form').attr('action', action);

                window.dispatchEvent(
                    new CustomEvent('open-modal', {
                        detail: 'confirm-restore-user'
                    })
                );
            });

            $(document).on('click', '.force-delete-btn', function () {

                let action = $(this).data('url');

                $('#confirm-force-delete-form').attr('action', action);

                window.dispatchEvent(
                    new CustomEvent('open-modal', {
                        detail: 'confirm-force-delete'
                    })
                );
            });
        </script>
    @endpush
</x-app-layout>
