<?php

namespace App\Exports;

use App\Models\Classroom;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentTemplateExport implements
    FromCollection,
    WithHeadings,
    ShouldAutoSize
{
    public function collection(): Collection
    {
        $classroom = Classroom::query()
            ->with('grade')
            ->first();

        return collect([
            [

                'student_number' => '202600001',

                'nisn' => '1234567890',

                'student_name' => 'John Doe',

                'gender' => 'Male',

                'classroom' => $classroom
                    ? $classroom->grade->name
                        .' - '
                        .$classroom->name
                    : 'Grade Name - Classroom Name',

                'birth_place' => 'Jakarta',

                'birth_date' => '2008-01-01',

                'phone' => '081234567890',

                'email' => 'john@example.com',

                'status' => 'Active',

            ],
        ]);
    }

    public function headings(): array
    {
        return [

            'Student Number',
            'NISN',
            'Student Name',
            'Gender',
            'Classroom',
            'Birth Place',
            'Birth Date',
            'Phone',
            'Email',
            'Status',

        ];
    }
}
