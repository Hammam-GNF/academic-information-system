<?php

namespace App\Repositories\Eloquent;

use App\Models\Subject;
use App\Repositories\Contracts\SubjectRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class SubjectRepository extends BaseRepository implements SubjectRepositoryInterface
{
    public function __construct(Subject $model)
    {
        parent::__construct($model);
    }

    public function query(): Builder
    {
        return $this->model
            ->newQuery()
            ->with('department')
            ->latest();
    }

    public function findById(int $id): ?Subject
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
