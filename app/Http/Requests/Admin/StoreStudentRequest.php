<?php

namespace App\Http\Requests\Admin;

use App\Models\Student;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can(
            'create',
            Student::class
        );
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
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

            'photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
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

            'is_active' => [
                'boolean',
            ],

        ];
    }
}
