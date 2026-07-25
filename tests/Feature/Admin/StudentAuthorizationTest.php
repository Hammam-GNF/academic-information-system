<?php

use App\Models\Classroom;
use App\Models\Student;
use App\Models\User;

it('guest cannot access student routes', function () {

    $student = Student::factory()->create();

    $routes = [

        route('admin.students.index'),

        route('admin.students.create'),

        route('admin.students.edit', $student),

    ];

    foreach ($routes as $route) {

        $this->get($route)
            ->assertRedirect(route('login'));

    }

});

it('user role cannot access student routes', function () {

    $user = User::factory()->create();
    $user->assignRole('user');

    $student = Student::factory()->create();

    $routes = [

        route('admin.students.index'),

        route('admin.students.create'),

        route('admin.students.edit', $student),

    ];

    foreach ($routes as $route) {

        $this->actingAs($user)
            ->get($route)
            ->assertForbidden();

    }

});

it('user role cannot create student', function () {

    $user = User::factory()->create();
    $user->assignRole('user');

    $classroom = Classroom::factory()->create();

    $this->actingAs($user)
        ->post(route('admin.students.store'), [

            'classroom_id' => $classroom->id,

            'student_number' => '202600001',

            'name' => 'John Doe',

            'gender' => 'male',

            'birth_place' => 'Jakarta',

            'birth_date' => '2008-01-01',

            'is_active' => true,

        ])
        ->assertForbidden();

});

it('user role cannot update student', function () {

    $user = User::factory()->create();
    $user->assignRole('user');

    $student = Student::factory()->create();

    $this->actingAs($user)
        ->put(route('admin.students.update', $student), [

            'classroom_id' => $student->classroom_id,

            'student_number' => $student->student_number,

            'nisn' => $student->nisn,

            'name' => 'Updated',

            'gender' => $student->gender,

            'birth_place' => $student->birth_place,

            'birth_date' => $student->birth_date->format('Y-m-d'),

            'phone' => $student->phone,

            'email' => $student->email,

            'address' => $student->address,

            'is_active' => true,

        ])
        ->assertForbidden();

});

it('user role cannot delete student', function () {

    $user = User::factory()->create();
    $user->assignRole('user');

    $student = Student::factory()->create();

    $this->actingAs($user)
        ->delete(route('admin.students.destroy', $student))
        ->assertForbidden();

});

it('admin can access student routes', function () {

    $admin = User::factory()->create();
    $admin->assignRole('admin');

    $student = Student::factory()->create();

    $routes = [

        route('admin.students.index'),

        route('admin.students.create'),

        route('admin.students.edit', $student),

    ];

    foreach ($routes as $route) {

        $this->actingAs($admin)
            ->get($route)
            ->assertOk();

    }

});
