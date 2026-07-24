<?php

use App\Models\Department;
use App\Models\Subject;
use App\Models\User;

beforeEach(function () {

    $admin = User::factory()->create();
    $admin->assignRole('admin');

    $this->actingAs($admin);
});

it('admin can create subject', function () {

    $department = Department::factory()->create();

    $response = $this->post(route('admin.subjects.store'), [
        'department_id' => $department->id,
        'code' => 'MTK001',
        'name' => 'Mathematics',
        'credit_hours' => 3,
        'description' => 'Basic mathematics subject',
        'is_active' => true,
    ]);

    $response
        ->assertRedirect(route('admin.subjects.index'))
        ->assertSessionHas('success');

    expect(
        Subject::where('code', 'MTK001')->exists()
    )->toBeTrue();
});

it('admin can update subject', function () {

    $department = Department::factory()->create();

    $newDepartment = Department::factory()->create();

    $subject = Subject::factory()->create([
        'department_id' => $department->id,
    ]);

    $response = $this->put(
        route('admin.subjects.update', $subject),
        [
            'department_id' => $newDepartment->id,
            'code' => 'BIO001',
            'name' => 'Biology',
            'credit_hours' => 4,
            'description' => 'Updated biology subject',
            'is_active' => false,
        ]
    );

    $response
        ->assertRedirect(route('admin.subjects.index'))
        ->assertSessionHas('success');

    $subject->refresh();

    expect($subject->department_id)
        ->toBe($newDepartment->id);

    expect($subject->code)
        ->toBe('BIO001');

    expect($subject->name)
        ->toBe('Biology');

    expect($subject->credit_hours)
        ->toBe(4);

    expect($subject->description)
        ->toBe('Updated biology subject');

    expect($subject->is_active)
        ->toBeFalse();
});

it('admin can delete subject', function () {

    $subject = Subject::factory()->create();

    $response = $this->delete(
        route('admin.subjects.destroy', $subject)
    );

    $response
        ->assertRedirect(route('admin.subjects.index'))
        ->assertSessionHas('success');

    expect(
        $subject->fresh()->trashed()
    )->toBeTrue();
});

it('non admin cannot delete subject', function () {

    $user = User::factory()->create();
    $user->assignRole('user');

    $subject = Subject::factory()->create();

    $this->actingAs($user);

    $this->delete(
        route('admin.subjects.destroy', $subject)
    )->assertForbidden();
});
