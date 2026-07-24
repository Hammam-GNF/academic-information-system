<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Grade;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Classroom>
 */
class ClassroomFactory extends Factory
{
    public function definition(): array
    {
        return [
            'department_id' => Department::factory(),

            'grade_id' => Grade::factory(),

            'name' => fake()->unique()->randomElement([
                'Class A',
                'Class B',
                'Class C',
                'Class D',
            ]),

            'capacity' => fake()->numberBetween(
                20,
                50
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
