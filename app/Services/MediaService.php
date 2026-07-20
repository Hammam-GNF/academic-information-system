<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Contracts\MediaRepositoryInterface;
use App\Services\Contracts\MediaServiceInterface;
use Illuminate\Http\RedirectResponse;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaService implements MediaServiceInterface
{
    public function __construct(
        protected MediaRepositoryInterface $mediaRepository,
    ) {}

    public function index(User $user)
    {
        return $this->mediaRepository->getUserMedia($user);
    }

    public function upload(User $user, string $requestField): RedirectResponse
    {
        $this->mediaRepository->upload($user, $requestField);

        return back()->with(
            'success',
            'File uploaded successfully.'
        );
    }

    public function delete(Media $media, User $user): RedirectResponse
    {
        abort_if($media->model_id !== $user->id, 403);

        $this->mediaRepository->delete($media);

        return back()->with(
            'success',
            'File deleted successfully.'
        );
    }
}
