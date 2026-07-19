@props([
    'title',
])

<div {{ $attributes->merge(['class' => 'dashboard-panel']) }}>

    <div class="dashboard-panel-header">

        <h2 class="dashboard-panel-title">

            {{ $title }}

        </h2>

    </div>

    <div class="dashboard-panel-body">

        {{ $slot }}

    </div>

</div>
