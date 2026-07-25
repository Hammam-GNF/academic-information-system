<?php

namespace Database\Factories;

use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Student>
 */
class StudentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'classroom_id' => Classroom::factory(),

            'student_number' => fake()
                ->unique()
                ->numerify('2026#####'),

            'nisn' => fake()
                ->optional()
                ->numerify('##########'),

            'name' => fake()->name(),

            'gender' => fake()->randomElement([
                'male',
                'female',
            ]),

            'birth_place' => fake()->city(),

            'birth_date' => fake()->date(),

            'phone' => fake()
                ->optional()
                ->phoneNumber(),

            'email' => fake()
                ->optional()
                ->safeEmail(),

            'address' => fake()
                ->optional()
                ->address(),

            'photo' => null,

            'is_active' => true,
        ];
    }

    public function active(): static
    {
        return $this->state(fn () => [
            'is_active' => true,
        ]);
    }

    public function inactive(): static
    {
        return $this->state(fn () => [
            'is_active' => false,
        ]);
    }
}
