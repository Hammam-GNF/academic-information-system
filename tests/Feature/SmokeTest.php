<?php

use App\Models\User;

it('redirects guests to login page', function () {
    $this->get('/admin/dashboard')
        ->assertRedirect(route('login'));
});

it('authenticated user can access profile page', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('profile.edit'))
        ->assertOk();
});
