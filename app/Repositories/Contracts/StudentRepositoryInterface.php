<?php

namespace App\Repositories\Contracts;

use App\Models\Student;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

interface StudentRepositoryInterface extends BaseRepositoryInterface
{
    public function query(): Builder;

    public function findById(int $id): ?Student;

    public function getActive(): Collection;

    public function findByStudentNumber(
        string $studentNumber
    ): ?Student;
}
