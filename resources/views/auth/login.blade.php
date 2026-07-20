<x-guest-layout>

    <x-slot name="title">
        Welcome Back
    </x-slot>

    <x-slot name="description">
        Sign in to continue to your account.
    </x-slot>
    
    <!-- Session Status -->
    <x-feedback.auth-session-status class="mb-4" :status="session('status')" />

    <form
        method="POST"
        action="{{ route('login') }}"
        x-data="{ loading: false }"
        x-on:submit="loading = true"
    >
        @csrf

        <!-- Email Address -->
        <div>
            <x-forms.input-label for="email" :value="__('Email')" />
            <x-forms.text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-feedback.input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="auth-section">
            <x-forms.input-label for="password" :value="__('Password')" />

            <x-forms.text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-feedback.input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="auth-actions">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-buttons.primary class="w-full justify-center sm:w-auto sm:justify-start sm:ms-3">
                {{ __('Log in') }}
            </x-buttons.primary>
        </div>
    </form>
</x-guest-layout>
