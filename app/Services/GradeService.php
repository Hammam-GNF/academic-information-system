<?php

namespace App\Services;

use App\Models\Grade;
use App\Repositories\Contracts\GradeRepositoryInterface;
use App\Services\Contracts\GradeServiceInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class GradeService implements GradeServiceInterface
{
    public function __construct(
        protected GradeRepositoryInterface $gradeRepository,
    ) {}

    public function query(): Builder
    {
        return $this->gradeRepository->query();
    }


    public function findById(int $id): ?Grade
    {
        return $this->gradeRepository->findById($id);
    }

    public function getActive(): Collection
    {
        return $this->gradeRepository->getActive();
    }
}
