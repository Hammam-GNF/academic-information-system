<?php

use App\Models\User;
use App\Models\Setting;

beforeEach(function () {

    $admin = User::factory()->create();
    $admin->assignRole('admin');

    $this->actingAs($admin);

    Setting::insert([
        [
            'key' => 'app_name',
            'value' => 'Laravel Template',
        ],
        [
            'key' => 'app_email',
            'value' => 'admin@example.com',
        ],
        [
            'key' => 'app_phone',
            'value' => '08123456789',
        ],
    ]);
});

it('admin can view settings page', function () {

    $this->get(route('admin.settings.index'))
        ->assertOk()
        ->assertViewIs('admin.settings.index');
});

it('admin can update settings', function () {

    $response = $this->put(route('admin.settings.update'), [
        'app_name' => 'My Application',
        'app_email' => 'owner@example.com',
        'app_phone' => '089999999999',
    ]);

    $response
        ->assertRedirect()
        ->assertSessionHas('success');

    expect(
        Setting::where('key', 'app_name')->value('value')
    )->toBe('My Application');

    expect(
        Setting::where('key', 'app_email')->value('value')
    )->toBe('owner@example.com');

    expect(
        Setting::where('key', 'app_phone')->value('value')
    )->toBe('089999999999');
});

it('settings validation is enforced', function () {

    $response = $this->from(route('admin.settings.index'))
        ->put(route('admin.settings.update'), [
            'app_name' => '',
            'app_email' => 'invalid-email',
            'app_phone' => '',
        ]);

    $response
        ->assertRedirect(route('admin.settings.index'))
        ->assertSessionHasErrors([
            'app_name',
            'app_email',
            'app_phone',
        ]);
});
