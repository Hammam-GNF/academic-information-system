@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'feedback-status']) }}>
        {{ $status }}
    </div>
@endif
