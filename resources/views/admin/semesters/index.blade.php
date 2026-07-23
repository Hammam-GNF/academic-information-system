<x-app-layout>

    <x-slot name="header">
        Semester Management
    </x-slot>

    <x-crud.page
        title="Semester Management"
        description="Manage academic semesters."
    >

        <x-slot name="actions">

            @can('create', App\Models\Semester::class)

                <a
                    href="{{ route('admin.semesters.create') }}"
                    class="btn btn-primary"
                >
                    Create Semester
                </a>

            @endcan

        </x-slot>

        <x-crud.table-card>

            <table
                id="semesters-table"
                class="table"
            >

                <thead class="table-head">

                    <tr>

                        <th class="table-th">
                            No
                        </th>

                        <th class="table-th">
                            Academic Year
                        </th>

                        <th class="table-th">
                            Name
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
        name="confirm-delete-semester"
        title="Delete Semester"
        message="Are you sure you want to delete this semester?"
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

                $('#semesters-table').DataTable({

                    processing: true,

                    serverSide: true,

                    ajax: '{{ route('admin.semesters.index') }}',

                    columns: [

                        {
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            searchable: false,
                            orderable: false,
                        },

                        {
                            data: 'academic_year',
                            name: 'academicYear.name',
                        },

                        {
                            data: 'name',
                            name: 'name',
                        },

                        {
                            data: 'status',
                            name: 'is_active',
                        },

                        {
                            data: 'action',
                            name: 'action',
                            searchable: false,
                            orderable: false,
                        },

                    ],

                });

            });

            $(document).on(
                'click',
                '.delete-semester-btn',
                function () {

                    $('#confirm-delete-semester-form')
                        .attr('action', $(this).data('url'));

                    window.dispatchEvent(
                        new CustomEvent(
                            'open-modal',
                            {
                                detail: 'confirm-delete-semester',
                            }
                        )
                    );

                }
            );

        </script>

    @endpush

</x-app-layout>
