<?php

namespace Database\Factories;

use App\Models\Grade;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Grade>
 */
class GradeFactory extends Factory
{
    public function definition(): array
    {
        $minimumScore = fake()->randomElement([
            0,
            60,
            70,
            80,
        ]);

        $maximumScore = fake()->numberBetween(
            $minimumScore + 1,
            100
        );

        return [
            'code' => strtoupper(
                fake()->unique()->lexify('GRD??')
            ),

            'name' => fake()->randomElement([
                'A',
                'B',
                'C',
                'D',
                'E',
            ]),

            'minimum_score' => $minimumScore,

            'maximum_score' => $maximumScore,

            'grade_point' => fake()->randomFloat(
                2,
                0,
                4
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
