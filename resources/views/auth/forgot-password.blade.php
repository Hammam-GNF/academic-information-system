<x-guest-layout>

    <x-slot name="title">
        Forgot Password
    </x-slot>

    <x-slot name="description">
        Enter your email address and we'll send you a reset link.
    </x-slot>

    <!-- Session Status -->
    <x-feedback.auth-session-status class="mb-4" :status="session('status')" />

    <form
        method="POST"
        action="{{ route('password.email') }}"
        x-data="{ loading: false }"
        x-on:submit="loading = true"
    >
        @csrf

        <!-- Email Address -->
        <div>
            <x-forms.input-label for="email" :value="__('Email')" />
            <x-forms.text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-feedback.input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="auth-actions">
            <x-buttons.primary class="w-full justify-center sm:w-auto">
                {{ __('Send Reset Link') }}
            </x-buttons.primary>
        </div>
    </form>
</x-guest-layout>
