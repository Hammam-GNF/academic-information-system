<?php

namespace App\Services\Contracts;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

interface AuthServiceInterface
{
    public function login(LoginRequest $request): RedirectResponse;
    
    public function register(RegisterRequest $request): RedirectResponse;

    public function sendPasswordResetLink(Request $request): RedirectResponse;

    public function logout(): void;

}
