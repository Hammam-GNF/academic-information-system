<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            User Management
        </h2>
    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-layout.page-header
                title="User Management"
            >

                <x-slot name="actions">

                    <div>
                        <select
                            id="role-filter"
                            name="role"
                            class="form-select block w-full"
                        >
                            <option value="">
                                All Roles
                            </option>

                            <option value="admin">
                                Admin
                            </option>

                            <option value="user">
                                User
                            </option>
                        </select>
                    </div>

                    <a
                        href="{{ route('admin.users.export') }}"
                        class="btn btn-success"
                    >
                        Export Excel
                    </a>

                    @can('create', App\Models\User::class)
                        <a
                            href="{{ route('admin.users.create') }}"
                            class="btn btn-primary"
                        >
                            Create User
                        </a>
                    @endcan

                    <a
                        href="{{ route('admin.users.trash') }}"
                        class="btn btn-danger"
                    >
                        Trash
                    </a>

                </x-slot>

            </x-layout.page-header>
            
            <x-layout.card class="overflow-x-auto">

                <table id="users-table" class="table">

                    <thead class="table-head">
                        <tr>
                            <th class="table-th">No</th>
                            <th class="table-th">Name</th>
                            <th class="table-th">Email</th>
                            <th class="table-th">Role</th>
                            <th class="table-th">Action</th>
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
        name="confirm-delete-user"
        title="Delete User"
        message="Are you sure you want to delete this user?"
        method="DELETE"
        submit-text="Delete"
    />

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
        <script>
            $(function () {

                let table = $('#users-table').DataTable({
                    processing: true,
                    serverSide: true,

                    ajax: {
                        url: '{{ route("admin.users.index") }}',
                        data: function (d) {
                            d.role = $('#role-filter').val();
                        }
                    },

                    columns: [
                        {
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            searchable: false,
                            orderable: false
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'role',
                            name: 'role'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            searchable: false,
                            orderable: false
                        }
                    ]
                });

                $('#role-filter').change(function () {
                    table.draw();
                });
            });

            $(document).on('click', '.delete-user-btn', function () {

                let action = $(this).data('url');

                $('#confirm-delete-user-form').attr('action', action);

                window.dispatchEvent(
                    new CustomEvent('open-modal', {
                        detail: 'confirm-delete-user'
                    })
                );
            });
        </script>
    @endpush
</x-app-layout>
