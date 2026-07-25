<?php

use App\Models\Classroom;
use App\Models\Student;
use App\Models\User;

beforeEach(function () {

    $admin = User::factory()->create();
    $admin->assignRole('admin');

    $this->actingAs($admin);

});

it('admin can view student index', function () {

    $this->get(route('admin.students.index'))
        ->assertOk();

});

it('admin can view create student page', function () {

    $this->get(route('admin.students.create'))
        ->assertOk();

});

it('admin can create student', function () {

    $classroom = Classroom::factory()->create();

    $response = $this->post(
        route('admin.students.store'),
        [

            'classroom_id' => $classroom->id,

            'student_number' => '202600001',

            'nisn' => '1234567890',

            'name' => 'John Doe',

            'gender' => 'male',

            'birth_place' => 'Jakarta',

            'birth_date' => '2008-01-01',

            'phone' => '081234567890',

            'email' => 'john@example.com',

            'address' => 'Jl. Testing',

            'is_active' => true,

        ]
    );

    $response
        ->assertRedirect(route('admin.students.index'))
        ->assertSessionHas('success');

    expect(
        Student::where(
            'student_number',
            '202600001'
        )->exists()
    )->toBeTrue();

});

it('admin can view edit student page', function () {

    $student = Student::factory()->create();

    $this->get(
        route(
            'admin.students.edit',
            $student
        )
    )->assertOk();

});

it('admin can update student', function () {

    $student = Student::factory()->create();

    $classroom = Classroom::factory()->create();

    $response = $this->put(
        route(
            'admin.students.update',
            $student
        ),
        [

            'classroom_id' => $classroom->id,

            'student_number' => '202600999',

            'nisn' => '9999999999',

            'name' => 'Updated Student',

            'gender' => 'female',

            'birth_place' => 'Bandung',

            'birth_date' => '2009-05-10',

            'phone' => '082222222222',

            'email' => 'updated@example.com',

            'address' => 'Updated Address',

            'is_active' => false,

        ]
    );

    $response
        ->assertRedirect(route('admin.students.index'))
        ->assertSessionHas('success');

    $student->refresh();

    expect($student->student_number)
        ->toBe('202600999');

    expect($student->name)
        ->toBe('Updated Student');

    expect($student->gender)
        ->toBe('female');

    expect($student->email)
        ->toBe('updated@example.com');

    expect($student->is_active)
        ->toBeFalse();

});

it('admin can soft delete student', function () {

    $student = Student::factory()->create();

    $response = $this->delete(
        route(
            'admin.students.destroy',
            $student
        )
    );

    $response
        ->assertRedirect(route('admin.students.index'))
        ->assertSessionHas('success');

    expect(
        $student->fresh()->trashed()
    )->toBeTrue();

});
