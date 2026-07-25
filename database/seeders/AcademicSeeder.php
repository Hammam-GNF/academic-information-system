<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AcademicSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AcademicYearSeeder::class,
            SemesterSeeder::class,
            DepartmentSeeder::class,
            GradeSeeder::class,
            ClassroomSeeder::class,
            SubjectSeeder::class,
        ]);
    }
}
