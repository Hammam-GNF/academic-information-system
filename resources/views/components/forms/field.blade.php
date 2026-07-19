@props([
    'label' => null,
    'for' => null,
    'error' => null,
])

<div {{ $attributes->merge(['class' => 'space-y-2']) }}>
    @if($label)
        <x-forms.input-label
            :for="$for"
            :value="$label"
        />
    @endif

    {{ $slot }}

    @if($error)
        <x-feedback.input-error :messages="$error" />
    @endif
</div>
