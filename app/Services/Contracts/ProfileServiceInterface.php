<?php

namespace App\Services\Contracts;

use App\Http\Requests\Profile\UpdateAvatarRequest;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

interface ProfileServiceInterface
{
    public function update(
        ProfileUpdateRequest $request
    ): RedirectResponse;

    public function updateAvatar(
        UpdateAvatarRequest $request
    ): RedirectResponse;

    public function destroy(
        Request $request
    ): RedirectResponse;
}
