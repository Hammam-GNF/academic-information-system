@props([
    'title',
    'value',
])

<div class="dashboard-card">

    <div class="flex items-start justify-between">

        <div>

            <p class="dashboard-label">
                {{ $title }}
            </p>

            <p class="dashboard-value">
                {{ $value }}
            </p>

        </div>

        <div class="dashboard-icon">

            {{ $icon ?? '' }}

        </div>

    </div>

</div>
