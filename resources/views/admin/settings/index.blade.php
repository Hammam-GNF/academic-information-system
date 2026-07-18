<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Admin Settings
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('admin.settings.update') }}">
                        @csrf
                        @method('PUT')

                        {{-- General Settings --}}
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold mb-4">
                                General Settings
                            </h3>

                            <div class="mb-4">
                                <x-forms.input-label
                                    for="app_name"
                                    value="Application Name"
                                />

                                <x-forms.text-input
                                    id="app_name"
                                    name="app_name"
                                    type="text"
                                    class="block mt-1 w-full"
                                    :value="old('app_name', $settings['app_name'] ?? '')"
                                    required
                                />

                                <x-feedback.input-error
                                    :messages="$errors->get('app_name')"
                                    class="mt-2"
                                />
                            </div>

                            <div class="mb-4">
                                <x-forms.input-label
                                    for="app_description"
                                    value="Application Description"
                                />

                                <textarea
                                    id="app_description"
                                    name="app_description"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                    rows="3"
                                >{{ old('app_description', $settings['app_description'] ?? '') }}</textarea>

                                <x-feedback.input-error
                                    :messages="$errors->get('app_description')"
                                    class="mt-2"
                                />
                            </div>
                        </div>

                        {{-- Company Settings --}}
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold mb-4">
                                Company Settings
                            </h3>

                            <div class="mb-4">
                                <x-forms.input-label
                                    for="company_email"
                                    value="Company Email"
                                />

                                <x-forms.text-input
                                    id="company_email"
                                    name="company_email"
                                    type="email"
                                    class="block mt-1 w-full"
                                    :value="old('company_email', $settings['company_email'] ?? '')"
                                    required
                                />

                                <x-feedback.input-error
                                    :messages="$errors->get('company_email')"
                                    class="mt-2"
                                />
                            </div>

                            <div class="mb-4">
                                <x-forms.input-label
                                    for="company_phone"
                                    value="Company Phone"
                                />

                                <x-forms.text-input
                                    id="company_phone"
                                    name="company_phone"
                                    type="text"
                                    class="block mt-1 w-full"
                                    :value="old('company_phone', $settings['company_phone'] ?? '')"
                                    required
                                />

                                <x-feedback.input-error
                                    :messages="$errors->get('company_phone')"
                                    class="mt-2"
                                />
                            </div>

                            <div class="mb-4">
                                <x-forms.input-label
                                    for="company_address"
                                    value="Company Address"
                                />

                                <textarea
                                    id="company_address"
                                    name="company_address"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                    rows="3"
                                >{{ old('company_address', $settings['company_address'] ?? '') }}</textarea>

                                <x-feedback.input-error
                                    :messages="$errors->get('company_address')"
                                    class="mt-2"
                                />
                            </div>
                        </div>

                        {{-- System Settings --}}
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold mb-4">
                                System Settings
                            </h3>

                            <div class="mb-4">
                                <x-forms.input-label
                                    for="pagination_per_page"
                                    value="Pagination Per Page"
                                />

                                <x-forms.text-input
                                    id="pagination_per_page"
                                    name="pagination_per_page"
                                    type="number"
                                    min="1"
                                    class="block mt-1 w-full"
                                    :value="old('pagination_per_page', $settings['pagination_per_page'] ?? 10)"
                                    required
                                />

                                <x-feedback.input-error
                                    :messages="$errors->get('pagination_per_page')"
                                    class="mt-2"
                                />
                            </div>

                            <div class="mb-4">
                                <label class="inline-flex items-center">
                                    <input
                                        type="checkbox"
                                        name="registration_enabled"
                                        value="1"
                                        class="rounded border-gray-300"
                                        @checked(old('registration_enabled', $settings['registration_enabled'] ?? false))
                                    >

                                    <span class="ml-2">
                                        Registration Enabled
                                    </span>
                                </label>

                                <x-feedback.input-error
                                    :messages="$errors->get('registration_enabled')"
                                    class="mt-2"
                                />
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <x-buttons.primary>
                                Save Settings
                            </x-buttons.primary>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>