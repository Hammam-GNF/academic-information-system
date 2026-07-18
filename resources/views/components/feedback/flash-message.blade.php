@if (session('success'))
    <div
        x-data="{ show: true }"
        x-show="show"
        x-transition
        x-init="setTimeout(() => show = false, 3000)"
        class="fixed top-4 right-4 z-50"
    >
        <div class="bg-green-600 text-white px-4 py-3 rounded-lg shadow-lg">
            {{ session('success') }}
        </div>
    </div>
@endif

@if (session('error'))
    <div
        x-data="{ show: true }"
        x-show="show"
        x-transition
        x-init="setTimeout(() => show = false, 3000)"
        class="fixed top-4 right-4 z-50"
    >
        <div class="bg-red-600 text-white px-4 py-3 rounded-lg shadow-lg">
            {{ session('error') }}
        </div>
    </div>
@endif

@if (session('warning'))
    <div
        x-data="{ show: true }"
        x-show="show"
        x-transition
        x-init="setTimeout(() => show = false, 3000)"
        class="fixed top-4 right-4 z-50"
    >
        <div class="bg-yellow-600 text-white px-4 py-3 rounded-lg shadow-lg">
            {{ session('warning') }}
        </div>
    </div>
@endif