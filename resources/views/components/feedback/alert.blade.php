@props([
    'type' => 'info',
    'dismissible' => false,
])

@php

$styles = [

    'success' => [
        'container' => 'border-green-200 bg-green-50',
        'title' => 'text-green-800',
        'text' => 'text-green-700',
    ],

    'danger' => [
        'container' => 'border-red-200 bg-red-50',
        'title' => 'text-red-800',
        'text' => 'text-red-700',
    ],

    'warning' => [
        'container' => 'border-yellow-200 bg-yellow-50',
        'title' => 'text-yellow-800',
        'text' => 'text-yellow-700',
    ],

    'info' => [
        'container' => 'border-blue-200 bg-blue-50',
        'title' => 'text-blue-800',
        'text' => 'text-blue-700',
    ],

];

$config = $styles[$type] ?? $styles['info'];

@endphp

<div
    x-data="{ show: true }"
    x-show="show"
    x-transition.opacity
    {{
        $attributes->merge([
            'class' => 'relative rounded-lg border p-4 '.$config['container'],
        ])
    }}
>

    @if ($dismissible)

        <button
            type="button"
            @click="show = false"
            class="absolute right-3 top-3 text-gray-500 transition hover:text-gray-700"
        >
            ✕
        </button>

    @endif

    @isset($title)

        <h3
            class="text-sm font-semibold {{ $config['title'] }}"
        >
            {{ $title }}
        </h3>

    @endisset

    <div
        class="mt-1 text-sm {{ $config['text'] }}"
    >
        {{ $slot }}
    </div>

</div>
