@props([
    'title',
    'description' => null,
])

<div class="crud-page">

    <div class="crud-header">

        <div>

            <h1 class="crud-title">
                {{ $title }}
            </h1>

            @if($description)
                <p class="crud-description">
                    {{ $description }}
                </p>
            @endif

        </div>

    </div>

    {{ $slot }}

</div>
