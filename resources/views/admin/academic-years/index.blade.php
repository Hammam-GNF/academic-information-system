<x-app-layout>

    <x-slot name="header">
        Academic Year Management
    </x-slot>

    <x-crud.page
        title="Academic Year Management"
        description="Manage academic years used by the academic information system."
    >

        <x-slot name="actions">

            <a
                href="{{ route('admin.academic-years.create') }}"
                class="btn btn-primary"
            >
                Create Academic Year
            </a>

        </x-slot>

        <x-crud.table-card>

            <table
                id="academic-years-table"
                class="table"
            >

                <thead class="table-head">

                    <tr>

                        <th class="table-th">
                            No
                        </th>

                        <th class="table-th">
                            Name
                        </th>

                        <th class="table-th">
                            Start Date
                        </th>

                        <th class="table-th">
                            End Date
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
        name="confirm-delete-academic-year"
        title="Delete Academic Year"
        message="Are you sure you want to delete this academic year?"
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

                let table = $('#academic-years-table').DataTable({

                    processing: true,

                    serverSide: true,

                    ajax: '{{ route("admin.academic-years.index") }}',

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
                            data: 'start_date',
                            name: 'start_date'
                        },

                        {
                            data: 'end_date',
                            name: 'end_date'
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
                '.delete-academic-year-btn',
                function () {

                    let action = $(this).data('url');

                    $('#confirm-delete-academic-year-form')
                        .attr('action', action);

                    window.dispatchEvent(

                        new CustomEvent(
                            'open-modal',
                            {
                                detail: 'confirm-delete-academic-year'
                            }
                        )

                    );

                }
            );

        </script>

    @endpush

</x-app-layout>
