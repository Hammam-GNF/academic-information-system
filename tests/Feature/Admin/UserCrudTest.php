<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

beforeEach(function () {

    $admin = User::factory()->create();
    $admin->assignRole('admin');

    $this->actingAs($admin);
});

const USER_EMAIL = 'john@example.com';

it('admin can create user', function () {

    $response = $this->post(route('admin.users.store'), [
        'name' => 'John Doe',
        'email' => USER_EMAIL,
        'password' => 'password',
        'password_confirmation' => 'password',
        'role' => 'user',
    ]);

    $response
        ->assertRedirect(route('admin.users.index'))
        ->assertSessionHas('success');

    $user = User::where('email', USER_EMAIL)->first();

    expect($user)
        ->not->toBeNull();

    expect($user->hasRole('user'))
        ->toBeTrue();
});

it('admin can update user', function () {

    $user = User::factory()->create();
    $user->assignRole('user');

    $response = $this->put(route('admin.users.update', $user), [
        'name' => 'Updated Name',
        'email' => 'updated@example.com',
        'role' => 'admin',
    ]);

    $response
        ->assertRedirect(route('admin.users.index'))
        ->assertSessionHas('success');

    $user->refresh();

    expect($user->name)
        ->toBe('Updated Name');

    expect($user->email)
        ->toBe('updated@example.com');

    expect($user->hasRole('admin'))
        ->toBeTrue();
});

it('admin can update user password', function () {

    $user = User::factory()->create();
    $user->assignRole('user');

    $response = $this->put(route('admin.users.update-password', $user), [
        'password' => 'newpassword',
        'password_confirmation' => 'newpassword',
    ]);

    $response
        ->assertRedirect(route('admin.users.index'))
        ->assertSessionHas('success');

    expect(
        Hash::check(
            'newpassword',
            $user->fresh()->password
        )
    )->toBeTrue();
});

it('admin can soft delete user', function () {

    $user = User::factory()->create();
    $user->assignRole('user');

    $response = $this->delete(route('admin.users.destroy', $user));

    $response
        ->assertRedirect(route('admin.users.index'))
        ->assertSessionHas('success');

    expect($user->fresh()->trashed())
        ->toBeTrue();
});

it('admin can restore user', function () {

    $user = User::factory()->create();
    $user->assignRole('user');

    $user->delete();

    $response = $this->put(route('admin.users.restore', $user->id));

    $response
        ->assertSessionHas('success');

    expect($user->fresh()->trashed())
        ->toBeFalse();
});

it('admin can permanently delete user', function () {

    $user = User::factory()->create();
    $user->assignRole('user');

    $id = $user->id;

    $user->delete();

    $response = $this->delete(route('admin.users.force-delete', $id));

    $response
        ->assertSessionHas('success');

    expect(
        User::withTrashed()->find($id)
    )->toBeNull();
});

it('admin cannot delete own account', function () {

    $admin = User::factory()->create();
    $admin->assignRole('admin');

    $this->actingAs($admin);

    $response = $this->delete(
        route('admin.users.destroy', $admin)
    );

    $response
        ->assertSessionHas('error');

    expect($admin->fresh())
        ->not->toBeNull();
});

it('last admin cannot be deleted', function () {

    /** @var User $admin */
    $admin = Auth::user();

    $response = $this->delete(
        route('admin.users.destroy', $admin)
    );

    $response
        ->assertSessionHas('error');

    expect(
        User::role('admin')->count()
    )->toBe(1);
});

it('non admin cannot delete user', function () {

    $user = User::factory()->create();
    $user->assignRole('user');

    $target = User::factory()->create();
    $target->assignRole('user');

    $this->actingAs($user);

    $this->delete(route('admin.users.destroy', $target))
        ->assertForbidden();
});
