<x-app-layout>

    <x-slot name="header">
        Classroom Management
    </x-slot>

    <x-crud.page
        title="Classroom Management"
        description="Manage classrooms used by the academic information system."
    >

        <x-slot name="actions">

            @can('create', App\Models\Classroom::class)

                <a
                    href="{{ route('admin.classrooms.create') }}"
                    class="btn btn-primary"
                >
                    Create Classroom
                </a>

            @endcan

        </x-slot>

        <x-crud.table-card>

            <table
                id="classrooms-table"
                class="table"
            >

                <thead class="table-head">

                    <tr>

                        <th class="table-th">
                            No
                        </th>

                        <th class="table-th">
                            Department
                        </th>

                        <th class="table-th">
                            Grade
                        </th>

                        <th class="table-th">
                            Classroom
                        </th>

                        <th class="table-th">
                            Capacity
                        </th>

                        <th class="table-th">
                            Status
                        </th>

                        <th class="table-th">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody></tbody>

            </table>

        </x-crud.table-card>

    </x-crud.page>

    <x-modals.confirm-modal
        name="confirm-delete-classroom"
        title="Delete Classroom"
        message="Are you sure you want to delete this classroom?"
        method="DELETE"
        submit-text="Delete"
    />

    @push('styles')

        <link
            rel="stylesheet"
            href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"
        >

    @endpush

    @push('scripts')

        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

        <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

        <script>

            $(function () {

                $('#classrooms-table').DataTable({

                    processing: true,

                    serverSide: true,

                    ajax: '{{ route("admin.classrooms.index") }}',

                    columns: [

                        {
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            searchable: false,
                            orderable: false
                        },

                        {
                            data: 'department',
                            name: 'department.name'
                        },

                        {
                            data: 'grade',
                            name: 'grade.name'
                        },

                        {
                            data: 'name',
                            name: 'name'
                        },

                        {
                            data: 'capacity',
                            name: 'capacity'
                        },

                        {
                            data: 'is_active',
                            name: 'is_active'
                        },

                        {
                            data: 'action',
                            name: 'action',
                            searchable: false,
                            orderable: false
                        }

                    ]

                });

            });

            $(document).on(
                'click',
                '.delete-classroom-btn',
                function () {

                    let action = $(this).data('url');

                    $('#confirm-delete-classroom-form')
                        .attr('action', action);

                    window.dispatchEvent(
                        new CustomEvent(
                            'open-modal',
                            {
                                detail: 'confirm-delete-classroom'
                            }
                        )
                    );

                }
            );

        </script>

    @endpush

</x-app-layout>
