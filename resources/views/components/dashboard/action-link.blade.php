<a
    {{ $attributes->merge([
        'class' => 'dashboard-action'
    ]) }}
>

    <span>

        {{ $slot }}

    </span>

    <span>

        →

    </span>

</a>
