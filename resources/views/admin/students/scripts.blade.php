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
                    orderable: false,
                },

                {
                    data: 'student',
                    name: 'name',
                },

                {
                    data: 'classroom',
                    name: 'classroom.name',
                },

                {
                    data: 'gender',
                    name: 'gender',
                },

                {
                    data: 'is_active',
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
        '.delete-student-btn',
        function () {

            $('#confirm-delete-student-form')
                .attr(
                    'action',
                    $(this).data('url')
                );

            window.dispatchEvent(
                new CustomEvent(
                    'open-modal',
                    {
                        detail: 'confirm-delete-student',
                    }
                )
            );

        }
    );

    $(document).on(
        'click',
        '#export-students-btn',
        function () {

            const alpine = Alpine.$data(
                this.parentElement
            );

            alpine.loading = true;

            window.location.href =
                '{{ route("admin.students.export") }}';

            setTimeout(
                () => alpine.loading = false,
                3000
            );

        }
    );

    $(document).on(
        'click',
        '#import-students-btn',
        function () {

            window.dispatchEvent(
                new CustomEvent(
                    'open-modal',
                    {
                        detail: 'import-students',
                    }
                )
            );

        }
    );

</script>

@if ($errors->has('import'))

<script>

    window.addEventListener(
        'load',
        () => {

            window.dispatchEvent(
                new CustomEvent(
                    'open-modal',
                    {
                        detail: 'import-students',
                    }
                )
            );

        }
    );

</script>

@endif
