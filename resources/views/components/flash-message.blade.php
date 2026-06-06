@if (session('success'))
    <div
        x-data="{ show: true }"
        x-show="show"
        x-init="setTimeout(() => show = false, 3000)"
        class="mb-4 rounded-lg bg-green-100 border border-green-400 text-green-700 px-4 py-3"
    >
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div
        x-data="{ show: true }"
        x-show="show"
        x-init="setTimeout(() => show = false, 3000)"
        class="mb-4 rounded-lg bg-red-100 border border-red-400 text-red-700 px-4 py-3"
    >
        {{ session('error') }}
    </div>
@endif

@if (session('warning'))
    <div
        x-data="{ show: true }"
        x-show="show"
        x-init="setTimeout(() => show = false, 3000)"
        class="mb-4 rounded-lg bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3"
    >
        {{ session('warning') }}
    </div>
@endif