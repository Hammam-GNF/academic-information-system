<x-guest-layout>

    <x-slot name="title">
        Create Account
    </x-slot>

    <x-slot name="description">
        Create your account to get started.
    </x-slot>
    
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-forms.input-label for="name" :value="__('Name')" />
            <x-forms.text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-feedback.input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="auth-section">
            <x-forms.input-label for="email" :value="__('Email')" />
            <x-forms.text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-feedback.input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="auth-section">
            <x-forms.input-label for="password" :value="__('Password')" />

            <x-forms.text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-feedback.input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="auth-section">
            <x-forms.input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-forms.text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-feedback.input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="auth-actions">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-buttons.primary class="w-full justify-center sm:w-auto sm:justify-start sm:ms-4">
                {{ __('Register') }}
            </x-buttons.primary>
        </div>
    </form>
</x-guest-layout>
