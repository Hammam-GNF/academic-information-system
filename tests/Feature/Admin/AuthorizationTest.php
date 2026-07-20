<?php

use App\Models\User;

it('guest cannot access admin routes', function () {
    $routes = [
        route('admin.dashboard'),
        route('admin.users.index'),
        route('admin.activity-logs.index'),
        route('admin.settings.index'),
        route('admin.media.index'),
    ];

    foreach ($routes as $route) {
        $this->get($route)
            ->assertRedirect(route('login'));
    }
});

it('user role cannot access admin routes', function () {
    $user = User::factory()->create();
    $user->assignRole('user');

    $routes = [
        route('admin.dashboard'),
        route('admin.users.index'),
        route('admin.activity-logs.index'),
        route('admin.settings.index'),
        route('admin.media.index'),
    ];

    foreach ($routes as $route) {
        $this->actingAs($user)
            ->get($route)
            ->assertForbidden();
    }
});

it('admin can access admin routes', function () {
    $admin = User::factory()->create();
    $admin->assignRole('admin');

    $routes = [
        route('admin.dashboard'),
        route('admin.users.index'),
        route('admin.activity-logs.index'),
        route('admin.settings.index'),
        route('admin.media.index'),
    ];

    foreach ($routes as $route) {
        $this->actingAs($admin)
            ->get($route)
            ->assertOk();
    }
});
