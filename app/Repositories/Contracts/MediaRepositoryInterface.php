<?php

namespace App\Repositories\Contracts;

use App\Models\User;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

interface MediaRepositoryInterface
{
    public function getUserMedia(User $user);

    public function upload(User $user, string $requestField): Media;

    public function delete(Media $media): void;
}
