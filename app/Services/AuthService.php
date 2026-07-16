<?php

namespace App\Services;

use App\Http\Requests\Auth\LoginRequest;
use App\Services\Contracts\AuthServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthService implements AuthServiceInterface
{
    public function login(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = $request->user();

        $redirect = $user->hasRole('admin')
            ? route('admin.dashboard')
            : route('dashboard');

        return redirect()
            ->intended($redirect)
            ->with('success', "Welcome back, {$user->name}.");
    }

    public function logout(): void
    {
        Auth::guard('web')->logout();
    }
}