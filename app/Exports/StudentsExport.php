<?php

namespace App\Exports;

use App\Models\Student;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentsExport implements
    FromCollection,
    WithHeadings,
    ShouldAutoSize
{
    /**
     * @return Collection<int, array<string, mixed>>
     */
    public function collection(): Collection
    {
        return Student::with([
            'classroom.grade',
        ])
            ->orderBy('student_number')
            ->get()
            ->map(function (Student $student) {

                return [

                    'student_number' => $student->student_number,

                    'nisn' => $student->nisn,

                    'name' => $student->name,

                    'gender' => ucfirst($student->gender),

                    'classroom' => $student->classroom
                        ? $student->classroom->grade->name
                            .' - '
                            .$student->classroom->name
                        : '-',

                    'birth_place' => $student->birth_place,

                    'birth_date' => optional(
                        $student->birth_date
                    )->format('Y-m-d'),

                    'phone' => $student->phone,

                    'email' => $student->email,

                    'status' => $student->is_active
                        ? 'Active'
                        : 'Inactive',

                ];
            });
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
