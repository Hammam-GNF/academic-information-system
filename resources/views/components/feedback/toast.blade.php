@props([
    'type' => null,
    'title' => null,
    'message' => null,
])

@php

if ($type && $message) {

    session()->flash($type, $message);

}

@endphp

@if (
    session()->has('success') ||
    session()->has('error') ||
    session()->has('warning') ||
    session()->has('info')
)

@php

$type = 'success';
$title = 'Success';
$message = session('success');

if (session()->has('error')) {
    $type = 'error';
    $title = 'Error';
    $message = session('error');
}

if (session()->has('warning')) {
    $type = 'warning';
    $title = 'Warning';
    $message = session('warning');
}

if (session()->has('info')) {
    $type = 'info';
    $title = 'Information';
    $message = session('info');
}

$icons = [
    'success' => '✓',
    'error' => '✕',
    'warning' => '!',
    'info' => 'i',
];

$classes = [
    'success' => 'toast-success',
    'error' => 'toast-error',
    'warning' => 'toast-warning',
    'info' => 'toast-info',
];

@endphp

<div
    x-data="{ show: true }"
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="translate-x-full opacity-0"
    x-transition:enter-end="translate-x-0 opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="translate-x-0 opacity-100"
    x-transition:leave-end="translate-x-full opacity-0"
    x-init="setTimeout(() => show = false, 3000)"
    class="fixed top-5 right-5 z-[9999]"
>

    <div class="toast {{ $classes[$type] }}">

        <div class="toast-icon">
            {{ $icons[$type] }}
        </div>

        <div class="flex-1">

            <div class="toast-title">
                {{ $title }}
            </div>

            <div class="toast-message">
                {{ $message }}
            </div>

            <div class="toast-progress"></div>

        </div>

        <button
            class="toast-close"
            @click="show=false"
            type="button"
        >
            ✕
        </button>

    </div>

</div>

@endif
