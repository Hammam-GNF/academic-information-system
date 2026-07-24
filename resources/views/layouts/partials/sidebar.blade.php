<aside
    x-cloak
    class="fixed inset-y-0 left-0 z-50 flex w-64 -translate-x-full flex-col border-r border-gray-200 bg-white transition-transform duration-300 lg:static lg:translate-x-0"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
>

    {{-- Logo --}}
    <div class="flex h-16 items-center justify-between border-b px-6">

        <a
            href="{{ route('admin.dashboard') }}"
            class="flex items-center gap-3"
        >

            <x-branding.application-logo
                class="h-8 w-8 text-gray-800"
            />

            <span class="text-lg font-bold text-gray-900">
                Laravel Template
            </span>

        </a>

        <button
            @click="sidebarOpen = false"
            class="text-gray-500 hover:text-gray-900 lg:hidden"
        >

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
                    d="M6 18L18 6M6 6l12 12"
                />

            </svg>

        </button>

    </div>

    <div class="flex-1 overflow-y-auto px-4 py-6">

        {{-- ========================= --}}
        {{-- Main Menu --}}
        {{-- ========================= --}}

        <div
            x-data="{
                open:
                    {{ request()->routeIs('admin.dashboard')
                        || request()->routeIs('admin.users.*')
                        || request()->routeIs('admin.activity-logs.*')
                        || request()->routeIs('admin.settings.*')
                        || request()->routeIs('admin.media.*')
                            ? 'true'
                            : 'false'
                    }}
            }"
        >

            <button
                @click="open = ! open"
                class="flex w-full items-center justify-between px-3 text-xs font-semibold uppercase tracking-wider text-gray-400"
            >

                <span>
                    Main Menu
                </span>

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4 transition-transform"
                    :class="{ 'rotate-180': open }"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M19 9l-7 7-7-7"
                    />

                </svg>

            </button>

            <nav
                x-show="open"
                x-collapse
                class="mt-3 space-y-1"
            >

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="{{ request()->routeIs('admin.dashboard')
                        ? 'bg-indigo-50 text-indigo-700 font-semibold'
                        : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900'
                    }} flex items-center rounded-lg px-3 py-2 transition"
                >
                    Dashboard
                </a>

                <a
                    href="{{ route('admin.users.index') }}"
                    class="{{ request()->routeIs('admin.users.*')
                        ? 'bg-indigo-50 text-indigo-700 font-semibold'
                        : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900'
                    }} flex items-center rounded-lg px-3 py-2 transition"
                >
                    Users
                </a>

                <a
                    href="{{ route('admin.activity-logs.index') }}"
                    class="{{ request()->routeIs('admin.activity-logs.*')
                        ? 'bg-indigo-50 text-indigo-700 font-semibold'
                        : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900'
                    }} flex items-center rounded-lg px-3 py-2 transition"
                >
                    Activity Logs
                </a>

                <a
                    href="{{ route('admin.settings.index') }}"
                    class="{{ request()->routeIs('admin.settings.*')
                        ? 'bg-indigo-50 text-indigo-700 font-semibold'
                        : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900'
                    }} flex items-center rounded-lg px-3 py-2 transition"
                >
                    Settings
                </a>

                <a
                    href="{{ route('admin.media.index') }}"
                    class="{{ request()->routeIs('admin.media.*')
                        ? 'bg-indigo-50 text-indigo-700 font-semibold'
                        : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900'
                    }} flex items-center rounded-lg px-3 py-2 transition"
                >
                    Media Library
                </a>

            </nav>

        </div>

        {{-- ========================= --}}
        {{-- Academic Management --}}
        {{-- ========================= --}}

        <div
            x-data="{
                open:
                    {{ request()->routeIs('admin.academic-years.*')
                        || request()->routeIs('admin.semesters.*')
                        || request()->routeIs('admin.departments.*')
                        || request()->routeIs('admin.grades.*')
                        || request()->routeIs('admin.classrooms.*')
                        || request()->routeIs('admin.subjects.*')
                            ? 'true'
                            : 'false'
                    }}
            }"
            class="mt-8"
        >

            <button
                @click="open = ! open"
                class="flex w-full items-center justify-between px-3 text-xs font-semibold uppercase tracking-wider text-gray-400"
            >

                <span>
                    Academic Management
                </span>

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4 transition-transform"
                    :class="{ 'rotate-180': open }"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M19 9l-7 7-7-7"
                    />

                </svg>

            </button>

            <nav
                x-show="open"
                x-collapse
                class="mt-3 space-y-1"
            >

                <a
                    href="{{ route('admin.academic-years.index') }}"
                    class="{{ request()->routeIs('admin.academic-years.*')
                        ? 'bg-indigo-50 text-indigo-700 font-semibold'
                        : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900'
                    }} flex rounded-lg px-3 py-2 transition"
                >
                    Academic Years
                </a>

                <a
                    href="{{ route('admin.semesters.index') }}"
                    class="{{ request()->routeIs('admin.semesters.*')
                        ? 'bg-indigo-50 text-indigo-700 font-semibold'
                        : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900'
                    }} flex rounded-lg px-3 py-2 transition"
                >
                    Semesters
                </a>

                <a
                    href="{{ route('admin.departments.index') }}"
                    class="{{ request()->routeIs('admin.departments.*')
                        ? 'bg-indigo-50 text-indigo-700 font-semibold'
                        : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900'
                    }} flex rounded-lg px-3 py-2 transition"
                >
                    Departments
                </a>

                <a
                    href="{{ route('admin.grades.index') }}"
                    class="{{ request()->routeIs('admin.grades.*')
                        ? 'bg-indigo-50 text-indigo-700 font-semibold'
                        : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900'
                    }} flex rounded-lg px-3 py-2 transition"
                >
                    Grades
                </a>

                <a
                    href="{{ route('admin.classrooms.index') }}"
                    class="{{ request()->routeIs('admin.classrooms.*')
                        ? 'bg-indigo-50 text-indigo-700 font-semibold'
                        : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900'
                    }} flex rounded-lg px-3 py-2 transition"
                >
                    Classrooms
                </a>

                <a
                    href="{{ route('admin.subjects.index') }}"
                    class="{{ request()->routeIs('admin.subjects.*')
                        ? 'bg-indigo-50 text-indigo-700 font-semibold'
                        : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900'
                    }} flex rounded-lg px-3 py-2 transition"
                >
                    Subjects
                </a>

            </nav>

        </div>

    </div>

</aside>
