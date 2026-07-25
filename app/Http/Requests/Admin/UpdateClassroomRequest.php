<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateClassroomRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can(
            'update',
            $this->route('classroom')
        );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $classroom = $this->route('classroom');

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
                    ->ignore($classroom)
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
