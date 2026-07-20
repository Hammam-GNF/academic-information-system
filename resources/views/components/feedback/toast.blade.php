@if (
    session()->has('success') ||
    session()->has('error') ||
    session()->has('warning') ||
    session()->has('info')
)

@php

$type = 'success';
$message = session('success');

if(session()->has('error')){
    $type='error';
    $message=session('error');
}

if(session()->has('warning')){
    $type='warning';
    $message=session('warning');
}

if(session()->has('info')){
    $type='info';
    $message=session('info');
}

$colors=[
    'success'=>'toast-success',
    'error'=>'toast-error',
    'warning'=>'toast-warning',
    'info'=>'toast-info',
];

@endphp

<div
    x-data="{ show:true }"
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="translate-x-full opacity-0"
    x-transition:enter-end="translate-x-0 opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="translate-x-0 opacity-100"
    x-transition:leave-end="translate-x-full opacity-0"
    x-init="setTimeout(()=>show=false,3000)"
    class="fixed top-5 right-5 z-[9999]"
>

    <div class="toast {{ $colors[$type] }}">

        <div class="flex-1">

            {{ $message }}

        </div>

        <button
            type="button"
            @click="show=false"
            class="toast-close"
        >
            ✕
        </button>

    </div>

</div>

@endif
