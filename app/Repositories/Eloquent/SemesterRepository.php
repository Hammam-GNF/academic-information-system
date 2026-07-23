<?php

namespace App\Repositories\Eloquent;

use App\Models\Semester;
use App\Repositories\Contracts\SemesterRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;

class SemesterRepository extends BaseRepository implements SemesterRepositoryInterface
{
    public function __construct(Semester $model)
    {
        parent::__construct($model);
    }

    public function query(): Builder
    {
        return $this->model
            ->newQuery()
            ->with('academicYear')
            ->latest();
    }

    public function findById(int $id): ?Semester
    {
        return $this->query()->find($id);
    }

    public function getActive(): ?Semester
    {
        return $this->query()
            ->where('is_active', true)
            ->first();
    }
}
