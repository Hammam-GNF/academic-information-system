<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\AcademicYear>
 */
class AcademicYearFactory extends Factory
{
    public function definition(): array
    {
        $startYear = fake()->numberBetween(
            2020,
            2030
        );

        return [
            'name' => $startYear . '/' . ($startYear + 1),

            'start_date' => $startYear . '-07-01',

            'end_date' => ($startYear + 1) . '-06-30',

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
