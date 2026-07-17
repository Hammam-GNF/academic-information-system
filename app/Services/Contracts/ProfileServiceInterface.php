<?php

namespace App\Services\Contracts;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;

interface ProfileServiceInterface
{
    public function update(
        ProfileUpdateRequest $request
    ): RedirectResponse;
}