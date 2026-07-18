<div class="min-h-screen bg-gray-100">

    @include('layouts.navigation')

    <x-layout.page-header
        :header="$header ?? null"
    />

    <main>

        @include('components.feedback.flash-message')

        {{ $slot }}

    </main>

</div>
