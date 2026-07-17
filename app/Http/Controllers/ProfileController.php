<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\UpdateAvatarRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Services\Contracts\ProfileServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function __construct(
        protected ProfileServiceInterface $profileService,
    ) {}

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        return $this->profileService->update($request);
    }

    public function updateAvatar(UpdateAvatarRequest $request): RedirectResponse
    {
        return $this->profileService
            ->updateAvatar($request);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        return $this->profileService
            ->destroy($request);
    }
}
