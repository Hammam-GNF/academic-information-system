<?php

use App\Models\AcademicYear;
use App\Models\Semester;
use App\Models\User;

beforeEach(function () {

    $admin = User::factory()->create();
    $admin->assignRole('admin');

    $this->actingAs($admin);

});

function createAcademicYear(): AcademicYear
{
    return AcademicYear::create([
        'name' => '2025/2026',
        'start_date' => '2025-07-01',
        'end_date' => '2026-06-30',
        'is_active' => true,
    ]);
}

it('admin can create semester', function () {

    $academicYear = createAcademicYear();

    $response = $this->post(route('admin.semesters.store'), [
        'academic_year_id' => $academicYear->id,
        'name' => 'Odd Semester',
        'start_date' => '2025-07-01',
        'end_date' => '2025-12-31',
        'is_active' => true,
    ]);

    $response
        ->assertRedirect(route('admin.semesters.index'))
        ->assertSessionHas('success');

    expect(
        Semester::where('name', 'Odd Semester')->exists()
    )->toBeTrue();

});

it('admin can update semester', function () {

    $academicYear = createAcademicYear();

    $semester = Semester::create([
        'academic_year_id' => $academicYear->id,
        'name' => 'Odd Semester',
        'start_date' => '2025-07-01',
        'end_date' => '2025-12-31',
        'is_active' => true,
    ]);

    $response = $this->put(
        route('admin.semesters.update', $semester),
        [
            'academic_year_id' => $academicYear->id,
            'name' => 'Even Semester',
            'start_date' => '2026-01-01',
            'end_date' => '2026-06-30',
            'is_active' => false,
        ]
    );

    $response
        ->assertRedirect(route('admin.semesters.index'))
        ->assertSessionHas('success');

    $semester->refresh();

    expect($semester->name)
        ->toBe('Even Semester');

    expect($semester->is_active)
        ->toBeFalse();

});

it('admin can delete semester', function () {

    $academicYear = createAcademicYear();

    $semester = Semester::create([
        'academic_year_id' => $academicYear->id,
        'name' => 'Odd Semester',
        'start_date' => '2025-07-01',
        'end_date' => '2025-12-31',
        'is_active' => true,
    ]);

    $response = $this->delete(
        route('admin.semesters.destroy', $semester)
    );

    $response
        ->assertRedirect(route('admin.semesters.index'))
        ->assertSessionHas('success');

    expect(
        Semester::find($semester->id)
    )->toBeNull();

});

it('non admin cannot delete semester', function () {

    $user = User::factory()->create();
    $user->assignRole('user');

    $academicYear = createAcademicYear();

    $semester = Semester::create([
        'academic_year_id' => $academicYear->id,
        'name' => 'Odd Semester',
        'start_date' => '2025-07-01',
        'end_date' => '2025-12-31',
        'is_active' => true,
    ]);

    $this->actingAs($user);

    $this->delete(
        route('admin.semesters.destroy', $semester)
    )->assertForbidden();

});
