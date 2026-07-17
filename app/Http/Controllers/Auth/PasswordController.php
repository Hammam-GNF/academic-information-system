<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UpdatePasswordRequest;
use App\Services\Contracts\AuthServiceInterface;
use Illuminate\Http\RedirectResponse;

class PasswordController extends Controller
{
    public function __construct(
        protected AuthServiceInterface $authService,
    ) {}

    public function update(
        UpdatePasswordRequest $request
    ): RedirectResponse {
        return $this->authService
            ->updatePassword($request);
    }
}
