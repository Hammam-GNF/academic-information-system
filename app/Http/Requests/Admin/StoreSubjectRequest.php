<?php

namespace App\Http\Requests\Admin;

use App\Models\Subject;
use Illuminate\Foundation\Http\FormRequest;

class StoreSubjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can(
            'create',
            Subject::class
        );
    }

    public function rules(): array
    {
        return [
            'department_id' => [
                'required',
                'exists:departments,id',
            ],

            'code' => [
                'required',
                'string',
                'max:20',
                'unique:subjects,code',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'credit_hours' => [
                'required',
                'integer',
                'min:1',
                'max:12',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'is_active' => [
                'required',
                'boolean',
            ],
        ];
    }
}
