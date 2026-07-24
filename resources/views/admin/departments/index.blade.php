<x-app-layout>

    <x-slot name="header">
        Department Management
    </x-slot>

    <x-crud.page
        title="Department Management"
        description="Manage departments used by the academic information system."
    >

        <x-slot name="actions">

            @can('create', App\Models\Department::class)

                <a
                    href="{{ route('admin.departments.create') }}"
                    class="btn btn-primary"
                >
                    Create Department
                </a>

            @endcan

        </x-slot>


        <x-crud.table-card>

            <table
                id="departments-table"
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
                            Description
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
        name="confirm-delete-department"
        title="Delete Department"
        message="Are you sure you want to delete this department?"
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

                $('#departments-table').DataTable({

                    processing: true,

                    serverSide: true,

                    ajax: '{{ route("admin.departments.index") }}',

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
                            data: 'description',
                            name: 'description'
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
                '.delete-department-btn',
                function () {

                    let action = $(this).data('url');


                    $('#confirm-delete-department-form')
                        .attr('action', action);


                    window.dispatchEvent(

                        new CustomEvent(
                            'open-modal',
                            {
                                detail: 'confirm-delete-department'
                            }
                        )

                    );

                }
            );


        </script>


    @endpush


</x-app-layout>
