<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        $subjects = [

            [
                'department' => 'TI',
                'code' => 'TI001',
                'name' => 'Programming Fundamentals',
                'credit_hours' => 3,
            ],

            [
                'department' => 'TI',
                'code' => 'TI002',
                'name' => 'Database Systems',
                'credit_hours' => 3,
            ],

            [
                'department' => 'TI',
                'code' => 'TI003',
                'name' => 'Web Development',
                'credit_hours' => 3,
            ],

            [
                'department' => 'TI',
                'code' => 'TI004',
                'name' => 'Software Engineering',
                'credit_hours' => 3,
            ],

            [
                'department' => 'SI',
                'code' => 'SI001',
                'name' => 'System Analysis',
                'credit_hours' => 3,
            ],

            [
                'department' => 'SI',
                'code' => 'SI002',
                'name' => 'Information System Management',
                'credit_hours' => 3,
            ],

            [
                'department' => 'SI',
                'code' => 'SI003',
                'name' => 'Database Management',
                'credit_hours' => 3,
            ],

            [
                'department' => 'AK',
                'code' => 'AK001',
                'name' => 'Financial Accounting',
                'credit_hours' => 3,
            ],

            [
                'department' => 'AK',
                'code' => 'AK002',
                'name' => 'Tax Accounting',
                'credit_hours' => 2,
            ],

            [
                'department' => 'MN',
                'code' => 'MN001',
                'name' => 'Business Management',
                'credit_hours' => 3,
            ],

            [
                'department' => 'MN',
                'code' => 'MN002',
                'name' => 'Marketing Management',
                'credit_hours' => 3,
            ],

        ];

        foreach ($subjects as $subject) {

            $department = Department::where(
                'code',
                $subject['department']
            )->firstOrFail();

            Subject::updateOrCreate(
                [
                    'code' => $subject['code'],
                ],
                [
                    'department_id' => $department->id,
                    'name' => $subject['name'],
                    'credit_hours' => $subject['credit_hours'],
                    'description' => $subject['name'],
                    'is_active' => true,
                ]
            );

        }
    }
}
