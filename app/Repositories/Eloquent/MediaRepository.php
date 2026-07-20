<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Contracts\MediaRepositoryInterface;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaRepository implements MediaRepositoryInterface
{
    public function getUserMedia(User $user)
    {
        return $user->getMedia('uploads');
    }

    public function upload(User $user, string $requestField): Media
    {
        return $user
            ->addMediaFromRequest($requestField)
            ->toMediaCollection('uploads');
    }

    public function delete(Media $media): void
    {
        $media->delete();
    }
}
