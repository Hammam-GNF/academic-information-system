<?php

use App\Models\User;
use Spatie\Activitylog\Models\Activity;

it('admin can access activity log page', function () {

    $admin = User::factory()->create();
    $admin->assignRole('admin');

    $this->actingAs($admin);

    $this->get(route('admin.activity-logs.index'))
        ->assertOk()
        ->assertViewIs('admin.activity-logs.index');
});

it('activity log datatable returns json response', function () {

    $admin = User::factory()->create();
    $admin->assignRole('admin');

    $this->actingAs($admin);

    activity()
        ->causedBy($admin)
        ->performedOn($admin)
        ->event('created')
        ->log('Testing activity');

    $response = $this->get(
        route('admin.activity-logs.index', [
            'draw' => 1,
            'start' => 0,
            'length' => 10,
        ]),
        [
            'X-Requested-With' => 'XMLHttpRequest',
        ]
    );

    $response
        ->assertOk()
        ->assertHeader('content-type', 'application/json');

    expect($response->json())
        ->toHaveKeys([
            'draw',
            'recordsTotal',
            'recordsFiltered',
            'data',
        ]);
});

it('activity log can be filtered by event', function () {

    $admin = User::factory()->create();
    $admin->assignRole('admin');

    $this->actingAs($admin);

    activity()
        ->causedBy($admin)
        ->performedOn($admin)
        ->event('created')
        ->log('Created');

    activity()
        ->causedBy($admin)
        ->performedOn($admin)
        ->event('deleted')
        ->log('Deleted');

    $response = $this->get(
        route('admin.activity-logs.index', [
            'draw' => 1,
            'start' => 0,
            'length' => 10,
            'event' => 'created',
        ]),
        [
            'X-Requested-With' => 'XMLHttpRequest',
        ]
    );

    $response->assertOk();

    expect($response->json('recordsFiltered'))
        ->toBe(1);
});

it('non admin cannot access activity log page', function () {

    $user = User::factory()->create();
    $user->assignRole('user');

    $this->actingAs($user);

    $this->get(route('admin.activity-logs.index'))
        ->assertForbidden();
});
