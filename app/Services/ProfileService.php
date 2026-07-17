<?php

namespace App\Services;

use App\Http\Requests\Profile\UpdateAvatarRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Contracts\ProfileServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProfileService implements ProfileServiceInterface
{
    public function __construct(
        protected UserRepositoryInterface $userRepository,
    ) {}

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
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
            ->causedBy($updated)
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

    public function updateAvatar(UpdateAvatarRequest $request): RedirectResponse
    {
        $user = $request->user();

        $user
            ->addMediaFromRequest('avatar')
            ->toMediaCollection('avatar');

        activity()
            ->causedBy($user)
            ->performedOn($user)
            ->event('avatar updated')
            ->log('Profile avatar has been updated.');

        return back()->with(
            'success',
            'Avatar updated successfully.'
        );
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => [
                'required',
                'current_password',
            ],
        ]);

        $user = $request->user();

        activity()
            ->causedBy($user)
            ->performedOn($user)
            ->event('account deleted')
            ->log('User deleted their own account.');

        Auth::logout();

        $this->userRepository->delete($user);

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return Redirect::to('/')
            ->with(
                'success',
                'Account deleted successfully.'
            );
    }
}
