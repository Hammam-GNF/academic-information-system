<?php

namespace App\Http\Requests\Admin;

use App\Models\Grade;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreGradeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can(
            'create',
            Grade::class
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
            'code' => [
                'required',
                'string',
                'max:20',
                'unique:grades,code',
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
