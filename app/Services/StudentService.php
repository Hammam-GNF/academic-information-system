<?php

namespace App\Services;

use App\Models\Student;
use App\Repositories\Contracts\StudentRepositoryInterface;
use App\Services\Contracts\StudentServiceInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class StudentService implements StudentServiceInterface
{
    public function __construct(
        protected StudentRepositoryInterface $studentRepository,
    ) {}

    public function query(): Builder
    {
        return $this->studentRepository->query();
    }

    public function findById(int $id): ?Student
    {
        return $this->studentRepository
            ->findById($id);
    }

    public function getActive(): Collection
    {
        return $this->studentRepository
            ->getActive();
    }

    public function findByStudentNumber(
        string $studentNumber
    ): ?Student {

        return $this->studentRepository
            ->findByStudentNumber(
                $studentNumber
            );
    }
}
