<?php

namespace App\Repositories\Eloquent;

use App\Models\AcademicYear;
use App\Repositories\Contracts\AcademicYearRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;

class AcademicYearRepository extends BaseRepository implements AcademicYearRepositoryInterface
{
    public function __construct(AcademicYear $model)
    {
        parent::__construct($model);
    }

    public function query(): Builder
    {
        return $this->model
            ->newQuery()
            ->latest();
    }

    public function findById(int $id): ?AcademicYear
    {
        return $this->query()->find($id);
    }

    public function getActive(): ?AcademicYear
    {
        return $this->query()
            ->where('is_active', true)
            ->first();
    }
}
