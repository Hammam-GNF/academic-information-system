<?php

namespace App\Services;

use App\Http\Requests\ProfileUpdateRequest;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Contracts\ProfileServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProfileService implements ProfileServiceInterface
{
    public function __construct(
        protected UserRepositoryInterface $userRepository,
    ) {}

    public function update(
        ProfileUpdateRequest $request
    ): RedirectResponse {

        $user = $request->user();

        $data = $request->validated();

        if (
            array_key_exists('email', $data)
            && $user->email !== $data['email']
        ) {
            $data['email_verified_at'] = null;
        }

        $updated = $this->userRepository->update(
            $user,
            $data
        );

        activity()
            ->causedBy(Auth::user())
            ->performedOn($updated)
            ->event('profile updated')
            ->withProperties([
                'name' => $updated->name,
                'email' => $updated->email,
            ])
            ->log('Profile has been updated.');

        return Redirect::route('profile.edit')
            ->with(
                'success',
                'Profile updated successfully.'
            );
    }
}