<?php

namespace App\Services\Contracts;

use App\Models\Student;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

interface StudentServiceInterface
{
    public function query(): Builder;

    public function findById(int $id): ?Student;

    public function getActive(): Collection;

    public function findByStudentNumber(
        string $studentNumber
    ): ?Student;
}
