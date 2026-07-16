<?php

namespace App\Services\Contracts;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;

interface AuthServiceInterface
{
    public function login(LoginRequest $request): RedirectResponse;

    public function logout(): void;
}