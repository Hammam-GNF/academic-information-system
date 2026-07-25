<?php

namespace App\Services\Contracts;

use App\Models\Student;
use Illuminate\Http\UploadedFile;

interface StudentPhotoServiceInterface
{
    public function upload(
        UploadedFile $photo
    ): string;

    public function replace(
        Student $student,
        UploadedFile $photo
    ): string;

    public function delete(
        Student $student
    ): void;
}
