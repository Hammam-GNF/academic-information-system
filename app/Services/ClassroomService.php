<?php

namespace App\Services;

use App\Models\Classroom;
use App\Repositories\Contracts\ClassroomRepositoryInterface;
use App\Services\Contracts\ClassroomServiceInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ClassroomService implements ClassroomServiceInterface
{
    public function __construct(
        protected ClassroomRepositoryInterface $classroomRepository,
    ) {}

    public function query(): Builder
    {
        return $this->classroomRepository->query();
    }

    public function findById(int $id): ?Classroom
    {
        return $this->classroomRepository->findById($id);
    }

    public function getActive(): Collection
    {
        return $this->classroomRepository->getActive();
    }
}
