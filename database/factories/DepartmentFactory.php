<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Department>
 */
class DepartmentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'code' => strtoupper(
                fake()->unique()->lexify('DEP???')
            ),

            'name' => fake()->unique()->randomElement([
                'Computer Science',
                'Information Technology',
                'Mathematics',
                'Physics',
                'Engineering',
                'Business Administration',
            ]),

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
