<?php

use App\Models\Grade;
use App\Models\User;

beforeEach(function () {

    $admin = User::factory()->create();
    $admin->assignRole('admin');

    $this->actingAs($admin);

});

const GRADE_CODE = 'A';

it('admin can create grade', function () {

    $response = $this->post(route('admin.grades.store'), [

        'code' => GRADE_CODE,
        'name' => 'Excellent',

        'minimum_score' => 85,
        'maximum_score' => 100,

        'grade_point' => 4.00,

        'description' => 'Excellent grade',

        'is_active' => true,

    ]);

    $response
        ->assertRedirect(route('admin.grades.index'))
        ->assertSessionHas('success');

    $grade = Grade::where(
        'code',
        GRADE_CODE
    )->first();

    expect($grade)
        ->not->toBeNull();

    expect($grade->name)
        ->toBe('Excellent');

    expect((float) $grade->grade_point)
        ->toBe(4.00);

});

it('admin can update grade', function () {

    $grade = Grade::factory()->create();

    $response = $this->put(
        route('admin.grades.update', $grade),
        [

            'code' => 'B',

            'name' => 'Very Good',

            'minimum_score' => 75,
            'maximum_score' => 84,

            'grade_point' => 3.50,

            'description' => 'Updated grade',

            'is_active' => false,

        ]
    );

    $response
        ->assertRedirect(route('admin.grades.index'))
        ->assertSessionHas('success');

    $grade->refresh();

    expect($grade->code)
        ->toBe('B');

    expect($grade->name)
        ->toBe('Very Good');

    expect((float) $grade->grade_point)
        ->toBe(3.50);

    expect($grade->is_active)
        ->toBeFalse();

});

it('admin can delete grade', function () {

    $grade = Grade::factory()->create();

    $response = $this->delete(
        route('admin.grades.destroy', $grade)
    );

    $response
        ->assertRedirect(route('admin.grades.index'))
        ->assertSessionHas('success');

    expect($grade->fresh()->trashed())
        ->toBeTrue();

});

it('non admin cannot delete grade', function () {

    $user = User::factory()->create();
    $user->assignRole('user');

    $grade = Grade::factory()->create();

    $this->actingAs($user);

    $this->delete(
        route('admin.grades.destroy', $grade)
    )->assertForbidden();

});
