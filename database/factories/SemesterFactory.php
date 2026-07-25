<?php

namespace Database\Factories;

use App\Models\AcademicYear;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Semester>
 */
class SemesterFactory extends Factory
{
    public function definition(): array
    {
        $startDate = fake()->dateTimeBetween(
            '2024-01-01',
            '2026-12-31'
        );

        return [
            'academic_year_id' => AcademicYear::factory(),

            'name' => fake()->randomElement([
                'Odd Semester',
                'Even Semester',
            ]),

            'start_date' => $startDate,

            'end_date' => fake()
                ->dateTimeBetween(
                    $startDate,
                    '+6 months'
                ),

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
