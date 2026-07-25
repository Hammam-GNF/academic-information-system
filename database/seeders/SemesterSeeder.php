<?php

namespace Database\Seeders;

use App\Models\AcademicYear;
use App\Models\Semester;
use Illuminate\Database\Seeder;

class SemesterSeeder extends Seeder
{
    public function run(): void
    {
        $academicYear = AcademicYear::where(
            'name',
            '2025/2026'
        )->first();

        Semester::updateOrCreate(
            [
                'academic_year_id' => $academicYear->id,
                'name' => 'Odd Semester',
            ],
            [
                'start_date' => '2025-07-01',
                'end_date' => '2025-12-31',
                'is_active' => true,
            ]
        );


        Semester::updateOrCreate(
            [
                'academic_year_id' => $academicYear->id,
                'name' => 'Even Semester',
            ],
            [
                'start_date' => '2026-01-01',
                'end_date' => '2026-06-30',
                'is_active' => false,
            ]
        );


        $previousYear = AcademicYear::where(
            'name',
            '2024/2025'
        )->first();


        Semester::updateOrCreate(
            [
                'academic_year_id' => $previousYear->id,
                'name' => 'Odd Semester',
            ],
            [
                'start_date' => '2024-07-01',
                'end_date' => '2024-12-31',
                'is_active' => false,
            ]
        );


        Semester::updateOrCreate(
            [
                'academic_year_id' => $previousYear->id,
                'name' => 'Even Semester',
            ],
            [
                'start_date' => '2025-01-01',
                'end_date' => '2025-06-30',
                'is_active' => false,
            ]
        );
    }
}
