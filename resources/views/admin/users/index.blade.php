<x-app-layout>
    <x-slot name="header">
        User Management
    </x-slot>

    <x-crud.page
        title="User Management"
        description="Manage application users, roles and permissions."
    >

        <x-slot name="actions">

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

        <x-crud.toolbar>

            <x-slot name="start">

                <select
                    id="role-filter"
                    name="role"
                    class="form-select min-w-[180px]"
                >
                    <option value="">All Roles</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>

            </x-slot>

            <div class="flex items-center gap-2">

                <input
                    id="table-search"
                    type="text"
                    placeholder="Search users..."
                    class="form-input w-full md:w-64"
                >

            </div>

        </x-crud.toolbar>

        <x-crud.table-card>

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

        </x-crud.table-card>

    </x-crud.page>

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

                $('#table-search').keyup(function () {

                    table.search($(this).val()).draw();

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
