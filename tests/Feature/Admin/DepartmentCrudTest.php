<?php

use App\Models\Department;
use App\Models\User;

beforeEach(function () {

    $admin = User::factory()->create();
    $admin->assignRole('admin');

    $this->actingAs($admin);

});

const DEPARTMENT_CODE = 'IF';
const DEPARTMENT_NAME = 'Informatics';

it('admin can create department', function () {

    $response = $this->post(route('admin.departments.store'), [
        'code' => DEPARTMENT_CODE,
        'name' => DEPARTMENT_NAME,
        'description' => 'Department description',
        'is_active' => true,
    ]);

    $response
        ->assertRedirect(route('admin.departments.index'))
        ->assertSessionHas('success');

    $department = Department::where(
        'code',
        DEPARTMENT_CODE
    )->first();

    expect($department)
        ->not->toBeNull();

    expect($department->name)
        ->toBe(DEPARTMENT_NAME);

});

it('admin can update department', function () {

    $department = Department::factory()->create();

    $response = $this->put(
        route('admin.departments.update', $department),
        [
            'code' => 'SI',
            'name' => 'Information System',
            'description' => 'Updated description',
            'is_active' => false,
        ]
    );

    $response
        ->assertRedirect(route('admin.departments.index'))
        ->assertSessionHas('success');

    $department->refresh();

    expect($department->code)
        ->toBe('SI');

    expect($department->name)
        ->toBe('Information System');

    expect($department->is_active)
        ->toBeFalse();

});

it('admin can delete department', function () {

    $department = Department::factory()->create();

    $response = $this->delete(
        route('admin.departments.destroy', $department)
    );

    $response
        ->assertRedirect(route('admin.departments.index'))
        ->assertSessionHas('success');

    expect($department->fresh()->trashed())
        ->toBeTrue();

});

it('non admin cannot delete department', function () {

    $user = User::factory()->create();
    $user->assignRole('user');

    $department = Department::factory()->create();

    $this->actingAs($user);

    $this->delete(
        route('admin.departments.destroy', $department)
    )->assertForbidden();

});
