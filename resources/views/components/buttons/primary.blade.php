<button
    {{
        $attributes->merge([
            'type' => 'submit',
            'class' => 'btn btn-primary',
        ])
    }}
    x-data="{ loading: false }"
    x-on:click="
        if ($el.form) {
            loading = true;
        }
    "
    x-bind:disabled="loading"
    x-bind:class="{ 'opacity-50 cursor-not-allowed': loading }"
>
    <span
        x-show="!loading"
        x-cloak
    >
        {{ $slot }}
    </span>

    <span
        x-show="loading"
        x-cloak
        class="inline-flex items-center gap-2"
    >
        <svg
            class="w-4 h-4 animate-spin"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
        >
            <circle
                class="opacity-25"
                cx="12"
                cy="12"
                r="10"
                stroke="currentColor"
                stroke-width="4"
            />

            <path
                class="opacity-75"
                fill="currentColor"
                d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"
            />
        </svg>

        Loading...
    </span>
</button>
