<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            [
                'code' => 'TI',
                'name' => 'Teknik Informatika',
                'description' => 'Program studi bidang teknologi informasi dan pengembangan perangkat lunak.',
                'is_active' => true,
            ],

            [
                'code' => 'SI',
                'name' => 'Sistem Informasi',
                'description' => 'Program studi bidang sistem informasi dan manajemen teknologi.',
                'is_active' => true,
            ],

            [
                'code' => 'AK',
                'name' => 'Akuntansi',
                'description' => 'Program studi bidang akuntansi dan keuangan.',
                'is_active' => true,
            ],

            [
                'code' => 'MN',
                'name' => 'Manajemen',
                'description' => 'Program studi bidang manajemen bisnis.',
                'is_active' => true,
            ],
        ];

        foreach ($departments as $department) {

            Department::updateOrCreate(
                [
                    'code' => $department['code'],
                ],
                $department
            );

        }
    }
}
