<?php

namespace Database\Seeders;

use App\Models\AcademicYear;
use Illuminate\Database\Seeder;

class AcademicYearSeeder extends Seeder
{
    public function run(): void
    {
        AcademicYear::updateOrCreate(
            [
                'name' => '2025/2026',
            ],
            [
                'start_date' => '2025-07-01',
                'end_date' => '2026-06-30',
                'is_active' => true,
            ]
        );

        AcademicYear::updateOrCreate(
            [
                'name' => '2024/2025',
            ],
            [
                'start_date' => '2024-07-01',
                'end_date' => '2025-06-30',
                'is_active' => false,
            ]
        );

        AcademicYear::updateOrCreate(
            [
                'name' => '2023/2024',
            ],
            [
                'start_date' => '2023-07-01',
                'end_date' => '2024-06-30',
                'is_active' => false,
            ]
        );
    }
}
