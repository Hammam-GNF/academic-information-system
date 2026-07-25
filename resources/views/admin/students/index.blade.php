<x-app-layout>

    <x-slot name="header">
        Student Management
    </x-slot>

    <x-crud.page
        title="Student Management"
        description="Manage student data in the academic information system."
    >

        <x-slot name="actions">

            @can('viewAny', App\Models\Student::class)

                <div x-data="{ loading: false }">

                    <x-buttons.download
                        id="export-students-btn"
                        loading-text="Exporting Excel..."
                    >
                        Export Excel
                    </x-buttons.download>

                </div>

            @endcan

            @can('create', App\Models\Student::class)

                <div x-data="{ loading: false }">

                    <x-buttons.download
                        id="import-students-btn"
                        loading-text="Opening..."
                    >
                        Import Excel
                    </x-buttons.download>

                </div>

            @endcan

            @can('create', App\Models\Student::class)

                <a
                    href="{{ route('admin.students.create') }}"
                    class="btn btn-primary"
                >
                    Create Student
                </a>

            @endcan

        </x-slot>

        <x-feedback.import-errors />

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

    <x-modals.import-modal
        name="import-students"
        title="Import Students"
        action="{{ route('admin.students.import') }}"
    />

    @push('scripts')

        @include('admin.students.scripts')

    @endpush

</x-app-layout>
