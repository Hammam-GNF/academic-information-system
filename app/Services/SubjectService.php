<?php

namespace App\Services;

use App\Models\Subject;
use App\Repositories\Contracts\SubjectRepositoryInterface;
use App\Services\Contracts\SubjectServiceInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class SubjectService implements SubjectServiceInterface
{
    public function __construct(
        protected SubjectRepositoryInterface $subjectRepository,
    ) {}

    public function query(): Builder
    {
        return $this->subjectRepository->query();
    }

    public function findById(int $id): ?Subject
    {
        return $this->subjectRepository->findById($id);
    }

    public function getActive(): Collection
    {
        return $this->subjectRepository->getActive();
    }
}
