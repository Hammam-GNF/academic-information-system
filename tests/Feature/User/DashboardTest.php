<?php

use App\Models\User;

it('user can access user dashboard', function () {

    $user = User::factory()->create();

    $user->assignRole('user');

    $this->actingAs($user)
        ->get(route('user.dashboard'))
        ->assertOk();

});
