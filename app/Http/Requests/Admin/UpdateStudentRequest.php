<?php

namespace App\Http\Requests\Admin;

use App\Models\Student;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can(
            'update',
            $this->route('student')
        );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        /** @var Student $student */
        $student = $this->route('student');

        return [

            'classroom_id' => [
                'required',
                'exists:classrooms,id',
            ],

            'student_number' => [
                'required',
                'string',
                'max:30',

                Rule::unique(
                    'students',
                    'student_number'
                )->ignore($student),
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'gender' => [
                'required',
                'in:male,female',
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

            'address' => [
                'nullable',
                'string',
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
                )->ignore($student),
            ],

            'is_active' => [
                'boolean',
            ],

        ];
    }
}
