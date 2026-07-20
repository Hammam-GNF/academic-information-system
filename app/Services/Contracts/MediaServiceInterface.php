<?php

namespace App\Services\Contracts;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

interface MediaServiceInterface
{
    public function index(User $user);

    public function upload(User $user, string $requestField): RedirectResponse;

    public function delete(Media $media, User $user): RedirectResponse;
}
