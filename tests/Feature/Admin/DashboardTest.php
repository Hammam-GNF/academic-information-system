<?php

use App\Models\User;

it('admin can access admin dashboard', function () {

    $admin = User::factory()->create();

    $admin->assignRole('admin');

    $this->actingAs($admin)
        ->get(route('admin.dashboard'))
        ->assertOk();

});

it('non admin cannot access admin dashboard', function () {

    $user = User::factory()->create();

    $user->assignRole('user');

    $this->actingAs($user)
        ->get(route('admin.dashboard'))
        ->assertForbidden();

});
