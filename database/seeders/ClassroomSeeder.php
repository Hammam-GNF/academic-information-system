<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Department;
use App\Models\Grade;
use Illuminate\Database\Seeder;

class ClassroomSeeder extends Seeder
{
    public function run(): void
    {
        $classrooms = [

            [
                'department' => 'TI',
                'grade' => 'A',
                'name' => 'TI-A',
                'capacity' => 40,
                'description' => 'Kelas Teknik Informatika A.',
            ],

            [
                'department' => 'TI',
                'grade' => 'B',
                'name' => 'TI-B',
                'capacity' => 40,
                'description' => 'Kelas Teknik Informatika B.',
            ],

            [
                'department' => 'SI',
                'grade' => 'A',
                'name' => 'SI-A',
                'capacity' => 35,
                'description' => 'Kelas Sistem Informasi A.',
            ],

            [
                'department' => 'SI',
                'grade' => 'B',
                'name' => 'SI-B',
                'capacity' => 35,
                'description' => 'Kelas Sistem Informasi B.',
            ],

            [
                'department' => 'AK',
                'grade' => 'A',
                'name' => 'AK-A',
                'capacity' => 35,
                'description' => 'Kelas Akuntansi A.',
            ],

            [
                'department' => 'MN',
                'grade' => 'A',
                'name' => 'MN-A',
                'capacity' => 35,
                'description' => 'Kelas Manajemen A.',
            ],

        ];

        foreach ($classrooms as $classroom) {

            $department = Department::where(
                'code',
                $classroom['department']
            )->firstOrFail();

            $grade = Grade::where(
                'code',
                $classroom['grade']
            )->firstOrFail();

            Classroom::updateOrCreate(
                [
                    'department_id' => $department->id,
                    'grade_id' => $grade->id,
                    'name' => $classroom['name'],
                ],
                [
                    'capacity' => $classroom['capacity'],
                    'description' => $classroom['description'],
                    'is_active' => true,
                ]
            );

        }
    }
}
