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

                You're successfully signed in. This dashboard is ready to be customized for your application.

            </p>

        </div>

        <div class="dashboard-widgets">

            <x-dashboard.panel
                title="Getting Started"
                class="lg:col-span-2"
            >

                <div class="space-y-4">

                    <p class="text-sm text-gray-600">

                        Your user dashboard has been successfully configured.
                        You can replace this page with modules, widgets, reports,
                        notifications, or any other content that fits your project.

                    </p>

                    <div class="rounded-lg border border-dashed border-gray-300 bg-gray-50 p-6 text-center">

                        <p class="font-medium text-gray-700">
                            🚀 Ready to build something great.
                        </p>

                        <p class="mt-2 text-sm text-gray-500">
                            Start adding your own dashboard components here.
                        </p>

                    </div>

                </div>

            </x-dashboard.panel>

            <x-dashboard.panel
                title="Quick Links"
            >

                <div class="space-y-3">

                    <x-dashboard.action-link
                        :href="route('profile.edit')"
                    >
                        Manage Profile
                    </x-dashboard.action-link>

                </div>

            </x-dashboard.panel>

        </div>

    </div>

</x-app-layout>
