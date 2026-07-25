<x-app-layout>

    <x-slot name="header">
        Student Management
    </x-slot>

    <x-crud.page
        title="Student Management"
        description="Manage student data in the academic information system."
    >

        <x-slot name="actions">

            @can('create', App\Models\Student::class)

                <a
                    href="{{ route('admin.students.create') }}"
                    class="btn btn-primary"
                >
                    Create Student
                </a>

            @endcan

        </x-slot>

        <x-crud.table-card>

            <table
                id="students-table"
                class="table"
            >

                <thead class="table-head">

                    <tr>

                        <th class="table-th">
                            No
                        </th>

                        <th class="table-th">
                            Student
                        </th>

                        <th class="table-th">
                            Classroom
                        </th>

                        <th class="table-th">
                            Gender
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

    @push('styles')

        <link
            rel="stylesheet"
            href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"
        >

    @endpush

    <x-modals.confirm-modal
        name="confirm-delete-student"
        title="Delete Student"
        message="Are you sure you want to delete this student?"
        method="DELETE"
        submit-text="Delete"
    />

    @push('scripts')

        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

        <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

        <script>

            $(function () {

                $('#students-table').DataTable({

                    processing: true,
                    serverSide: true,

                    ajax: '{{ route("admin.students.index") }}',

                    columns: [

                        {
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            searchable: false,
                            orderable: false
                        },

                        {
                            data: 'student',
                            name: 'name'
                        },

                        {
                            data: 'classroom',
                            name: 'classroom.name'
                        },

                        {
                            data: 'gender',
                            name: 'gender'
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
                '.delete-student-btn',
                function () {

                    let action = $(this).data('url');

                    $('#confirm-delete-student-form')
                        .attr('action', action);

                    window.dispatchEvent(
                        new CustomEvent(
                            'open-modal',
                            {
                                detail: 'confirm-delete-student'
                            }
                        )
                    );

                }
            );

        </script>

    @endpush

</x-app-layout>
