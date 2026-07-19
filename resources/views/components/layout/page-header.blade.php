@props([
    'title' => '',
])

<div {{ $attributes->class('flex items-center justify-between mb-6') }}>

    <div>
        <h2 class="text-xl font-semibold text-gray-900">
            {{ $title }}
        </h2>
    </div>

    @isset($actions)
        <div class="flex items-center gap-2">
            {{ $actions }}
        </div>
    @endisset

</div>
