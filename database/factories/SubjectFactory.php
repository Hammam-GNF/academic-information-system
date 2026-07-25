<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Subject>
 */
class SubjectFactory extends Factory
{
    public function definition(): array
    {
        return [
            'department_id' => Department::factory(),

            'code' => strtoupper(
                fake()->unique()->lexify('SUB???')
            ),

            'name' => fake()->randomElement([
                'Mathematics',
                'Programming',
                'Database System',
                'Computer Network',
                'Software Engineering',
                'Algorithm',
            ]),

            'credit_hours' => fake()->numberBetween(
                1,
                6
            ),

            'description' => fake()
                ->optional()
                ->sentence(),

            'is_active' => fake()->boolean(),
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
