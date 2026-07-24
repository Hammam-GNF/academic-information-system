<?php

namespace App\Http\Requests\Admin;

use App\Models\Classroom;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreClassroomRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can(
            'create',
            Classroom::class
        );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'department_id' => [
                'required',
                'exists:departments,id',
            ],

            'grade_id' => [
                'required',
                'exists:grades,id',
            ],

            'name' => [
                'required',
                'string',
                'max:100',

                Rule::unique('classrooms')
                    ->where(fn ($query) => $query
                        ->where(
                            'department_id',
                            $this->department_id
                        )
                        ->where(
                            'grade_id',
                            $this->grade_id
                        )
                    ),
            ],

            'capacity' => [
                'required',
                'integer',
                'min:1',
                'max:100',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'is_active' => [
                'boolean',
            ],

        ];
    }
}
