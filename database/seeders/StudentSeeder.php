<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $classrooms = Classroom::query()
            ->where('is_active', true)
            ->get();

        if ($classrooms->isEmpty()) {
            return;
        }


        $students = [
            [
                'name' => 'Ahmad Fauzan',
                'gender' => 'male',
            ],

            [
                'name' => 'Budi Santoso',
                'gender' => 'male',
            ],

            [
                'name' => 'Citra Lestari',
                'gender' => 'female',
            ],

            [
                'name' => 'Dinda Maharani',
                'gender' => 'female',
            ],

            [
                'name' => 'Eko Prasetyo',
                'gender' => 'male',
            ],

            [
                'name' => 'Fajar Ramadhan',
                'gender' => 'male',
            ],

            [
                'name' => 'Gita Permata',
                'gender' => 'female',
            ],

            [
                'name' => 'Hana Putri',
                'gender' => 'female',
            ],

            [
                'name' => 'Ilham Saputra',
                'gender' => 'male',
            ],

            [
                'name' => 'Joko Kurniawan',
                'gender' => 'male',
            ],

            [
                'name' => 'Kirana Ayu',
                'gender' => 'female',
            ],

            [
                'name' => 'Lukman Hakim',
                'gender' => 'male',
            ],

            [
                'name' => 'Maya Sari',
                'gender' => 'female',
            ],

            [
                'name' => 'Nadia Putri',
                'gender' => 'female',
            ],

            [
                'name' => 'Oscar Wijaya',
                'gender' => 'male',
            ],
        ];


        foreach ($students as $index => $student) {

            Student::updateOrCreate(
                [
                    'student_number' => '2026'
                        .str_pad(
                            $index + 1,
                            5,
                            '0',
                            STR_PAD_LEFT
                        ),
                ],
                [
                    'classroom_id' => $classrooms
                        ->random()
                        ->id,

                    'nisn' => '00'
                        .str_pad(
                            $index + 1,
                            8,
                            '0',
                            STR_PAD_LEFT
                        ),

                    'name' => $student['name'],

                    'gender' => $student['gender'],

                    'birth_place' => fake()->city(),

                    'birth_date' => fake()
                        ->dateTimeBetween(
                            '-22 years',
                            '-17 years'
                        )
                        ->format('Y-m-d'),

                    'phone' => fake()
                        ->numerify(
                            '08##########'
                        ),

                    'email' => strtolower(
                        str_replace(
                            ' ',
                            '.',
                            $student['name']
                        )
                    ).'@example.com',

                    'address' => fake()
                        ->address(),

                    'is_active' => true,
                ]
            );

        }


        Student::factory()
            ->count(35)
            ->create([
                'classroom_id' => $classrooms
                    ->random()
                    ->id,
            ]);

    }
}
