<?php

use App\Models\Classroom;
use App\Models\Department;
use App\Models\Grade;
use App\Models\User;

beforeEach(function () {

    $admin = User::factory()->create();
    $admin->assignRole('admin');

    $this->actingAs($admin);
});

it('admin can create classroom', function () {

    $department = Department::factory()->create();

    $grade = Grade::factory()->create();

    $response = $this->post(route('admin.classrooms.store'), [
        'department_id' => $department->id,
        'grade_id' => $grade->id,
        'name' => 'Class A',
        'capacity' => 36,
        'description' => 'First classroom',
        'is_active' => true,
    ]);

    $response
        ->assertRedirect(route('admin.classrooms.index'))
        ->assertSessionHas('success');

    expect(
        Classroom::where('name', 'Class A')->exists()
    )->toBeTrue();
});

it('admin can update classroom', function () {

    $department = Department::factory()->create();

    $grade = Grade::factory()->create();

    $classroom = Classroom::factory()->create([
        'department_id' => $department->id,
        'grade_id' => $grade->id,
    ]);

    $newDepartment = Department::factory()->create();

    $newGrade = Grade::factory()->create();

    $response = $this->put(
        route('admin.classrooms.update', $classroom),
        [
            'department_id' => $newDepartment->id,
            'grade_id' => $newGrade->id,
            'name' => 'Class B',
            'capacity' => 40,
            'description' => 'Updated classroom',
            'is_active' => false,
        ]
    );

    $response
        ->assertRedirect(route('admin.classrooms.index'))
        ->assertSessionHas('success');

    $classroom->refresh();

    expect($classroom->department_id)
        ->toBe($newDepartment->id);

    expect($classroom->grade_id)
        ->toBe($newGrade->id);

    expect($classroom->name)
        ->toBe('Class B');

    expect($classroom->capacity)
        ->toBe(40);

    expect($classroom->description)
        ->toBe('Updated classroom');

    expect($classroom->is_active)
        ->toBeFalse();
});

it('admin can delete classroom', function () {

    $classroom = Classroom::factory()->create();

    $response = $this->delete(
        route('admin.classrooms.destroy', $classroom)
    );

    $response
        ->assertRedirect(route('admin.classrooms.index'))
        ->assertSessionHas('success');

    expect(
        $classroom->fresh()->trashed()
    )->toBeTrue();
});

it('non admin cannot delete classroom', function () {

    $user = User::factory()->create();
    $user->assignRole('user');

    $classroom = Classroom::factory()->create();

    $this->actingAs($user);

    $this->delete(
        route('admin.classrooms.destroy', $classroom)
    )->assertForbidden();
});
