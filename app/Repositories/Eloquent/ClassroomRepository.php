<?php

namespace App\Repositories\Eloquent;

use App\Models\Classroom;
use App\Repositories\Contracts\ClassroomRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ClassroomRepository extends BaseRepository implements ClassroomRepositoryInterface
{
    public function __construct(Classroom $model)
    {
        parent::__construct($model);
    }

    public function query(): Builder
    {
        return $this->model
            ->newQuery()
            ->with([
                'department',
                'grade',
            ])
            ->latest();
    }

    public function findById(int $id): ?Classroom
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
