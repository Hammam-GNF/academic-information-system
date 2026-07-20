@props(['status'])

@if ($status)
    <x-feedback.toast
        type="success"
        title="Success"
        :message="$status"
    />
@endif
