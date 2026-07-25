<?php

use App\Models\Classroom;
use App\Models\Student;
use App\Models\User;

beforeEach(function () {

    $admin = User::factory()->create();
    $admin->assignRole('admin');

    $this->actingAs($admin);

});

it('requires mandatory fields when creating student', function () {

    $response = $this->post(
        route('admin.students.store'),
        []
    );

    $response->assertSessionHasErrors([

        'classroom_id',

        'student_number',

        'name',

        'gender',

        'birth_place',

        'birth_date',

    ]);

});

it('student number must be unique', function () {

    $student = Student::factory()->create();

    $classroom = Classroom::factory()->create();

    $response = $this->post(
        route('admin.students.store'),
        [

            'classroom_id' => $classroom->id,

            'student_number' => $student->student_number,

            'name' => 'John Doe',

            'gender' => 'male',

            'birth_place' => 'Jakarta',

            'birth_date' => '2008-01-01',

            'is_active' => true,

        ]
    );

    $response->assertSessionHasErrors([
        'student_number',
    ]);

});

it('nisn must be unique', function () {

    $student = Student::factory()->create([
        'nisn' => '1234567890',
    ]);

    $classroom = Classroom::factory()->create();

    $response = $this->post(
        route('admin.students.store'),
        [

            'classroom_id' => $classroom->id,

            'student_number' => '202600001',

            'nisn' => $student->nisn,

            'name' => 'John Doe',

            'gender' => 'male',

            'birth_place' => 'Jakarta',

            'birth_date' => '2008-01-01',

            'is_active' => true,

        ]
    );

    $response->assertSessionHasErrors([
        'nisn',
    ]);

});

it('email must be unique', function () {

    $student = Student::factory()->create([
        'email' => 'john@example.com',
    ]);

    $classroom = Classroom::factory()->create();

    $response = $this->post(
        route('admin.students.store'),
        [

            'classroom_id' => $classroom->id,

            'student_number' => '202600001',

            'name' => 'John Doe',

            'gender' => 'male',

            'birth_place' => 'Jakarta',

            'birth_date' => '2008-01-01',

            'email' => $student->email,

            'is_active' => true,

        ]
    );

    $response->assertSessionHasErrors([
        'email',
    ]);

});

it('allows updating student without changing unique fields', function () {

    $student = Student::factory()->create();

    $response = $this->put(
        route('admin.students.update', $student),
        [

            'classroom_id' => $student->classroom_id,

            'student_number' => $student->student_number,

            'nisn' => $student->nisn,

            'name' => $student->name,

            'gender' => $student->gender,

            'birth_place' => $student->birth_place,

            'birth_date' => $student->birth_date->format('Y-m-d'),

            'phone' => $student->phone,

            'email' => $student->email,

            'address' => $student->address,

            'is_active' => $student->is_active,

        ]
    );

    $response
        ->assertRedirect(route('admin.students.index'))
        ->assertSessionHasNoErrors();

});
