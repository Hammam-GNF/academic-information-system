<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Contracts\AuthServiceInterface;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    public function __construct(
        protected AuthServiceInterface $authService,
    ) {}

    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        return $this->authService->verifyEmail($request);
    }
}
