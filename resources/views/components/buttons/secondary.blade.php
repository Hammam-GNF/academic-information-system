<button
    {{
        $attributes->merge([
            'type' => 'button',
            'class' => 'btn btn-secondary',
        ])
    }}
    x-bind:disabled="loading"
    x-bind:class="{ 'opacity-50 cursor-not-allowed': loading }"
>
    {{ $slot }}
</button>
