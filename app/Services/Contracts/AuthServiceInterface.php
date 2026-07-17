<?php

namespace App\Services\Contracts;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\UpdatePasswordRequest;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

interface AuthServiceInterface
{
    public function login(LoginRequest $request): RedirectResponse;
    
    public function register(RegisterRequest $request): RedirectResponse;

    public function sendPasswordResetLink(Request $request): RedirectResponse;

    public function resetPassword(
        ResetPasswordRequest $request
    ): RedirectResponse;

    public function updatePassword(
        UpdatePasswordRequest $request
    ): RedirectResponse;

    public function verifyEmail(
        EmailVerificationRequest $request
    ): RedirectResponse;

    public function sendEmailVerificationNotification(
        Request $request
    ): RedirectResponse;

    public function logout(): void;

}
