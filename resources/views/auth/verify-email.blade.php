<x-guest-layout>

    <x-slot name="title">
        Verify Email
    </x-slot>

    <x-slot name="description">
        Verify your email address before continuing.
    </x-slot>

    <div class="mb-4 text-sm text-gray-600">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="auth-actions">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-buttons.primary class="w-full justify-center sm:w-auto">
                    {{ __('Resend Verification Email') }}
                </x-buttons.primary>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
