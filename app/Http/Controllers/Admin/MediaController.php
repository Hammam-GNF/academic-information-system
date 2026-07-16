<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMediaRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();
        $media = $user->getMedia('uploads');

        return view('admin.media.index', compact('media'));
    }

    public function store(StoreMediaRequest $request)
    {
        /** @var User $user */
        $user = Auth::user();
        $user
            ->addMediaFromRequest('file')
            ->toMediaCollection('uploads');

        return back()->with('success', 'File uploaded successfully.');
    }

    public function destroy(Media $media)
    {
        abort_if($media->model_id !== Auth::id(), 403);
        $media->delete();

        return back()->with('success', 'File deleted successfully.');
    }
}
