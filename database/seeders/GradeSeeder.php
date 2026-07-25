<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    public function run(): void
    {
        $grades = [
            [
                'code' => 'A',
                'name' => 'Excellent',
                'minimum_score' => 85,
                'maximum_score' => 100,
                'grade_point' => 4.00,
                'description' => 'Excellent achievement.',
                'is_active' => true,
            ],

            [
                'code' => 'AB',
                'name' => 'Very Good',
                'minimum_score' => 80,
                'maximum_score' => 84,
                'grade_point' => 3.50,
                'description' => 'Very good achievement.',
                'is_active' => true,
            ],

            [
                'code' => 'B',
                'name' => 'Good',
                'minimum_score' => 70,
                'maximum_score' => 79,
                'grade_point' => 3.00,
                'description' => 'Good achievement.',
                'is_active' => true,
            ],

            [
                'code' => 'BC',
                'name' => 'Fairly Good',
                'minimum_score' => 65,
                'maximum_score' => 69,
                'grade_point' => 2.50,
                'description' => 'Fairly good achievement.',
                'is_active' => true,
            ],

            [
                'code' => 'C',
                'name' => 'Satisfactory',
                'minimum_score' => 55,
                'maximum_score' => 64,
                'grade_point' => 2.00,
                'description' => 'Satisfactory achievement.',
                'is_active' => true,
            ],

            [
                'code' => 'D',
                'name' => 'Poor',
                'minimum_score' => 40,
                'maximum_score' => 54,
                'grade_point' => 1.00,
                'description' => 'Poor achievement.',
                'is_active' => true,
            ],

            [
                'code' => 'E',
                'name' => 'Failed',
                'minimum_score' => 0,
                'maximum_score' => 39,
                'grade_point' => 0.00,
                'description' => 'Failed achievement.',
                'is_active' => true,
            ],
        ];

        foreach ($grades as $grade) {

            Grade::updateOrCreate(
                [
                    'code' => $grade['code'],
                ],
                $grade
            );

        }
    }
}
