<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Contracts\AuthServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    public function __construct(
        protected AuthServiceInterface $authService,
    ) {}

    public function store(Request $request): RedirectResponse
    {
        return $this->authService
            ->sendEmailVerificationNotification($request);
    }
}
