<?php

namespace App\Repositories\Eloquent;

use App\Models\Grade;
use App\Repositories\Contracts\GradeRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class GradeRepository extends BaseRepository implements GradeRepositoryInterface
{
    public function __construct(Grade $model)
    {
        parent::__construct($model);
    }

    public function query(): Builder
    {
        return $this->model
            ->newQuery()
            ->latest();
    }

    public function findById(int $id): ?Grade
    {
        return $this->query()
            ->find($id);
    }

    public function getActive(): Collection
    {
        return $this->query()
            ->where('is_active', true)
            ->get();
    }
}
