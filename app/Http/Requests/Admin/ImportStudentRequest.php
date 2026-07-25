<?php

namespace App\Http\Requests\Admin;

use App\Models\Student;
use Illuminate\Foundation\Http\FormRequest;

class ImportStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can(
            'create',
            Student::class
        );
    }

    public function rules(): array
    {
        return [

            'file' => [
                'required',
                'file',
                'mimes:xlsx,xls',
            ],

        ];
    }
}
