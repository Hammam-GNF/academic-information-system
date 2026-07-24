<?php

use App\Models\AcademicYear;
use App\Models\User;

beforeEach(function () {

    $admin = User::factory()->create();
    $admin->assignRole('admin');

    $this->actingAs($admin);

});

it('admin can create academic year', function () {

    $response = $this->post(route('admin.academic-years.store'), [
        'name' => '2025/2026',
        'start_date' => '2025-07-01',
        'end_date' => '2026-06-30',
        'is_active' => true,
    ]);

    $response
        ->assertRedirect(route('admin.academic-years.index'))
        ->assertSessionHas('success');

    expect(
        AcademicYear::where('name', '2025/2026')->exists()
    )->toBeTrue();

});

it('admin can update academic year', function () {

    $academicYear = AcademicYear::create([
        'name' => '2025/2026',
        'start_date' => '2025-07-01',
        'end_date' => '2026-06-30',
        'is_active' => true,
    ]);

    $response = $this->put(
        route('admin.academic-years.update', $academicYear),
        [
            'name' => '2026/2027',
            'start_date' => '2026-07-01',
            'end_date' => '2027-06-30',
            'is_active' => false,
        ]
    );

    $response
        ->assertRedirect(route('admin.academic-years.index'))
        ->assertSessionHas('success');

    $academicYear->refresh();

    expect($academicYear->name)
        ->toBe('2026/2027');

    expect($academicYear->is_active)
        ->toBeFalse();

});

it('admin can delete academic year', function () {

    $academicYear = AcademicYear::create([
        'name' => '2025/2026',
        'start_date' => '2025-07-01',
        'end_date' => '2026-06-30',
        'is_active' => true,
    ]);

    $response = $this->delete(
        route('admin.academic-years.destroy', $academicYear)
    );

    $response
        ->assertRedirect(route('admin.academic-years.index'))
        ->assertSessionHas('success');

    expect(
        AcademicYear::find($academicYear->id)
    )->toBeNull();

});

it('non admin cannot delete academic year', function () {

    $user = User::factory()->create();
    $user->assignRole('user');

    $academicYear = AcademicYear::create([
        'name' => '2025/2026',
        'start_date' => '2025-07-01',
        'end_date' => '2026-06-30',
        'is_active' => true,
    ]);

    $this->actingAs($user);

    $this->delete(
        route('admin.academic-years.destroy', $academicYear)
    )->assertForbidden();

});
