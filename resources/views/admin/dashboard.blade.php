<x-app-layout>

    <x-slot name="header">
        Dashboard
    </x-slot>

    <div class="dashboard-container">

        <div class="dashboard-grid">

            <x-dashboard.stat-card
                title="Total Users"
                :value="$totalUsers"
            >
                <x-slot name="icon">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M17 20h5V4H2v16h5m10 0v-2a4 4 0 00-8 0v2m8 0H9m4-10a4 4 0 110-8 4 4 0 010 8z"
                        />
                    </svg>

                </x-slot>

            </x-dashboard.stat-card>

            <x-dashboard.stat-card
                title="Total Admins"
                :value="$totalAdmins"
            >
                <x-slot name="icon">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 14l9-5-9-5-9 5 9 5zm0 0v6"
                        />
                    </svg>

                </x-slot>

            </x-dashboard.stat-card>

            <x-dashboard.stat-card
                title="Activity Logs"
                :value="$totalActivities"
            >
                <x-slot name="icon">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 12h6m-6 4h6M7 4h10l2 2v14H5V6l2-2z"
                        />
                    </svg>

                </x-slot>

            </x-dashboard.stat-card>

        </div>

    </div>

</x-app-layout>
