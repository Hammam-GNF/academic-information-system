<?php

namespace App\Imports;

use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToCollection, WithHeadingRow
{
    protected array $errors = [];

    protected int $success = 0;

    protected int $failed = 0;

    public function collection(
        Collection $rows
    ): void {

        foreach ($rows as $index => $row) {

            $validator = Validator::make(
                $row->toArray(),
                [

                    'student_number' => [
                        'required',
                        'string',
                        'max:30',
                        Rule::unique(
                            'students',
                            'student_number'
                        ),
                    ],

                    'nisn' => [
                        'nullable',
                        'string',
                        'max:20',
                        Rule::unique(
                            'students',
                            'nisn'
                        ),
                    ],

                    'student_name' => [
                        'required',
                        'string',
                        'max:255',
                    ],

                    'gender' => [
                        'required',
                        Rule::in([
                            'Male',
                            'Female',
                        ]),
                    ],

                    'classroom' => [
                        'required',
                        'string',
                    ],

                    'birth_place' => [
                        'required',
                        'string',
                        'max:100',
                    ],

                    'birth_date' => [
                        'required',
                        'date',
                    ],

                    'phone' => [
                        'nullable',
                        'string',
                        'max:20',
                    ],

                    'email' => [
                        'nullable',
                        'email',
                        'max:255',
                        Rule::unique(
                            'students',
                            'email'
                        ),
                    ],

                    'status' => [
                        'required',
                        Rule::in([
                            'Active',
                            'Inactive',
                        ]),
                    ],

                ]
            );

            if ($validator->fails()) {

                $this->failed++;

                $this->errors[] =
                    'Row '.($index + 2).': '
                    .$validator->errors()->first();

                continue;

            }

            [$gradeName, $classroomName] = array_map(
                'trim',
                explode(
                    ' - ',
                    $row['classroom'],
                    2
                )
            );

            $classroom = Classroom::query()

                ->whereHas(
                    'grade',
                    fn ($query) => $query->where(
                        'name',
                        $gradeName
                    )
                )

                ->where(
                    'name',
                    $classroomName
                )

                ->first();

            if (! $classroom) {

                $this->failed++;

                $this->errors[] =
                    'Row '.($index + 2)
                    .': Classroom not found.';

                continue;

            }

            Student::create([

                'classroom_id' => $classroom->id,

                'student_number' => (string) $row['student_number'],

                'nisn' => $row['nisn']
                    ? (string) $row['nisn']
                    : null,

                'name' => $row['student_name'],

                'gender' => strtolower(
                    $row['gender']
                ),

                'birth_place' => $row['birth_place'],

                'birth_date' => $row['birth_date'],

                'phone' => $row['phone']
                    ? (string) $row['phone']
                    : null,

                'email' => $row['email'],

                'is_active' => $row['status'] === 'Active',

            ]);

            $this->success++;

        }

    }

    public function errors(): array
    {
        return $this->errors;
    }

    public function successCount(): int
    {
        return $this->success;
    }

    public function failedCount(): int
    {
        return $this->failed;
    }
}
