<x-app-layout>

    <x-slot name="header">
        Dashboard
    </x-slot>

    <div class="dashboard-container">

        <div class="dashboard-header">

            <h1 class="dashboard-title">

                Welcome back,
                {{ Auth::user()->name }}

            </h1>

            <p class="dashboard-description">

                Here's what's happening in your application today.

            </p>

        </div>

        <div class="dashboard-grid">

            <x-dashboard.stat-card
                title="Total Users"
                :value="$totalUsers"
                description="Registered accounts"
                color="indigo"
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
                description="Administrator accounts"
                color="green"
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
                description="Recorded system activities"
                color="amber"
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

        <div class="dashboard-widgets">

            <x-dashboard.panel
                title="Quick Actions"
            >

                <div class="space-y-3">

                    <x-dashboard.action-link
                        :href="route('admin.users.index')"
                    >
                        Manage Users
                    </x-dashboard.action-link>

                    <x-dashboard.action-link
                        :href="route('admin.activity-logs.index')"
                    >
                        Activity Logs
                    </x-dashboard.action-link>

                    <x-dashboard.action-link
                        :href="route('admin.media.index')"
                    >
                        Media Library
                    </x-dashboard.action-link>

                    <x-dashboard.action-link
                        :href="route('admin.settings.index')"
                    >
                        Settings
                    </x-dashboard.action-link>

                </div>

            </x-dashboard.panel>

            <x-dashboard.panel
                title="Recent Activities"
                class="lg:col-span-2"
            >

                @forelse($recentActivities as $activity)

                    <div class="dashboard-activity">

                        <div>

                            <p class="font-medium text-gray-900">

                                {{ Str::headline($activity->description) }}

                            </p>

                            <p class="mt-1 text-sm text-gray-500">

                                {{ optional($activity->causer)->name ?? 'System' }}

                            </p>

                        </div>

                        <span class="text-sm text-gray-400">

                            {{ $activity->created_at->diffForHumans() }}

                        </span>

                    </div>

                @empty

                    <p class="text-sm text-gray-500">

                        No activities found.

                    </p>

                @endforelse

            </x-dashboard.panel>

        </div>

    </div>

</x-app-layout>
