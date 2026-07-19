<div
    {{ $attributes->merge([
        'class' => 'crud-toolbar'
    ]) }}
>

    <div class="crud-toolbar-start">

        {{ $start ?? '' }}

    </div>

    <div class="crud-toolbar-end">

        {{ $slot }}

    </div>

</div>
