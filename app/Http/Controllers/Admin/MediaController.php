<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMediaRequest;
use App\Models\User;
use App\Services\Contracts\MediaServiceInterface;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaController extends Controller
{
    public function __construct(
        protected MediaServiceInterface $mediaService,
    ) {}

    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        $media = $this->mediaService->index($user);

        return view('admin.media.index', compact('media'));
    }

    public function store(StoreMediaRequest $request)
    {
        /** @var User $user */
        $user = Auth::user();

        return $this->mediaService->upload(
            $user,
            'file'
        );
    }

    public function destroy(Media $media)
    {
        /** @var User $user */
        $user = Auth::user();

        return $this->mediaService->delete(
            $media,
            $user
        );
    }
}
