<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateGradeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can(
            'update',
            $this->route('grade')
        );
    }

    /**
     * Get the validation rules that apply to this request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $grade = $this->route('grade');

        return [
            'code' => [
                'required',
                'string',
                'max:20',
                Rule::unique(
                    'grades',
                    'code'
                )->ignore($grade),
            ],

            'name' => [
                'required',
                'string',
                'max:100',
            ],

            'minimum_score' => [
                'required',
                'integer',
                'min:0',
                'max:100',
            ],

            'maximum_score' => [
                'required',
                'integer',
                'min:0',
                'max:100',
                'gte:minimum_score',
            ],

            'grade_point' => [
                'required',
                'numeric',
                'min:0',
                'max:4',
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
