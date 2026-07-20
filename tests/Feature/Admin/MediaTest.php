<?php

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

beforeEach(function () {

    Storage::fake('public');

    $admin = User::factory()->create();
    $admin->assignRole('admin');

    $this->actingAs($admin);
});

it('admin can view media page', function () {

    $this->get(route('admin.media.index'))
        ->assertOk()
        ->assertViewIs('admin.media.index');
});

it('admin can upload media', function () {

    $response = $this->post(route('admin.media.store'), [
        'file' => UploadedFile::fake()->image('avatar.jpg'),
    ]);

    $response
        ->assertRedirect()
        ->assertSessionHas('success');

    /** @var User $user */
    $user = Auth::user();

    expect(
        $user->fresh()
            ->getMedia('uploads')
    )->toHaveCount(1);

    expect(Media::count())
        ->toBe(1);
});

it('admin can delete own media', function () {

    /** @var User $user */
    $user = Auth::user();

    $media = $user
        ->addMedia(
            UploadedFile::fake()->image('photo.jpg')
        )
        ->toMediaCollection('uploads');

    $response = $this->delete(
        route('admin.media.destroy', $media)
    );

    $response
        ->assertRedirect()
        ->assertSessionHas('success');

    expect(
        Media::find($media->id)
    )->toBeNull();
});

it('admin cannot delete media owned by another user', function () {

    $another = User::factory()->create();
    $another->assignRole('admin');

    $media = $another
        ->addMedia(
            UploadedFile::fake()->image('another.jpg')
        )
        ->toMediaCollection('uploads');

    $this->delete(
        route('admin.media.destroy', $media)
    )->assertForbidden();

    expect(
        Media::find($media->id)
    )->not->toBeNull();
});
