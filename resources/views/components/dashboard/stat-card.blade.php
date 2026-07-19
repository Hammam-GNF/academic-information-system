@props([
    'title',
    'value',
    'description' => null,
    'color' => 'indigo',
])

@php

$iconClasses = match ($color) {

    'green' => 'bg-green-100 text-green-600',

    'amber' => 'bg-amber-100 text-amber-600',

    'red' => 'bg-red-100 text-red-600',

    'blue' => 'bg-blue-100 text-blue-600',

    default => 'bg-indigo-100 text-indigo-600',

};

@endphp

<div class="dashboard-card">

    <div class="flex items-start justify-between">

        <div>

            <p class="dashboard-label">

                {{ $title }}

            </p>

            <p class="dashboard-value">

                {{ $value }}

            </p>

            @if($description)

                <p class="mt-2 text-sm text-gray-500">

                    {{ $description }}

                </p>

            @endif

        </div>

        <div class="dashboard-icon {{ $iconClasses }}">

            {{ $icon ?? '' }}

        </div>

    </div>

</div>
