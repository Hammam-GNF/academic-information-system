<x-app-layout>

    <x-slot name="header">
        Grade Management
    </x-slot>

    <x-crud.page
        title="Grade Management"
        description="Manage grade master data."
    >

        <x-slot name="actions">

            @can('create', App\Models\Grade::class)

                <a
                    href="{{ route('admin.grades.create') }}"
                    class="btn btn-primary"
                >
                    Create Grade
                </a>

            @endcan

        </x-slot>

        <x-crud.table-card>

            <table
                id="grades-table"
                class="table"
            >

                <thead class="table-head">

                    <tr>

                        <th class="table-th">
                            No
                        </th>

                        <th class="table-th">
                            Code
                        </th>

                        <th class="table-th">
                            Name
                        </th>

                        <th class="table-th">
                            Grade Point
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
        name="confirm-delete-grade"
        title="Delete Grade"
        message="Are you sure you want to delete this grade?"
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

                $('#grades-table').DataTable({

                    processing: true,

                    serverSide: true,

                    ajax: '{{ route("admin.grades.index") }}',

                    columns: [

                        {
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            searchable: false,
                            orderable: false
                        },

                        {
                            data: 'code',
                            name: 'code'
                        },

                        {
                            data: 'name',
                            name: 'name'
                        },

                        {
                            data: 'grade_point',
                            name: 'grade_point'
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
                '.delete-grade-btn',
                function () {

                    let action = $(this).data('url');

                    $('#confirm-delete-grade-form')
                        .attr('action', action);

                    window.dispatchEvent(

                        new CustomEvent(
                            'open-modal',
                            {
                                detail: 'confirm-delete-grade'
                            }
                        )

                    );

                }
            );

        </script>

    @endpush

</x-app-layout>
