<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Activity Logs') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <x-layout.card>
                
                <div class="mb-4 flex gap-4">

                    <select id="event-filter" class="border-gray-300 rounded-md shadow-sm">
                        <option value="">All Events</option>
                        <option value="created">Created</option>
                        <option value="updated">Updated</option>
                        <option value="deleted">Deleted</option>
                    </select>
                    
                </div>

                <table id="activity-table" class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Event</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Target</th>
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

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
        <script>
            $(function () {

                let table = $('#activity-table').DataTable({

                    processing: true,
                    serverSide: true,

                    ajax: {
                        url: '{{ route("admin.activity-logs.index") }}',
                        data: function (d) {
                            d.event = $('#event-filter').val();
                        }
                    },

                    columns: [
                        {
                            data: 'user',
                            name: 'user'
                        },
                        {
                            data: 'event',
                            name: 'event'
                        },
                        {
                            data: 'description',
                            name: 'description'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: 'target',
                            name: 'target'
                        }
                    ]
                });

                $('#event-filter').change(function () {
                    table.draw();
                });

            });
        </script>
    @endpush
</x-app-layout>
