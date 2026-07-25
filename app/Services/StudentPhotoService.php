<?php

namespace App\Services;

use App\Models\Student;
use App\Services\Contracts\StudentPhotoServiceInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class StudentPhotoService implements StudentPhotoServiceInterface
{
    protected string $disk = 'public';

    protected string $directory = 'students';

    public function upload(
        UploadedFile $photo
    ): string {

        return $photo->store(
            $this->directory,
            $this->disk
        );
    }

    public function replace(
        Student $student,
        UploadedFile $photo
    ): string {

        if ($student->photo) {

            Storage::disk($this->disk)
                ->delete($student->photo);

        }

        return $this->upload($photo);
    }

    public function delete(
        Student $student
    ): void {

        if (! $student->photo) {
            return;
        }

        Storage::disk($this->disk)
            ->delete($student->photo);
    }
}
