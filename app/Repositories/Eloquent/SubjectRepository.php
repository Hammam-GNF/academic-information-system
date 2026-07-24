<?php

namespace App\Repositories\Eloquent;

use App\Models\Subject;
use App\Repositories\Contracts\SubjectRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class SubjectRepository implements SubjectRepositoryInterface
{
    public function query(): Builder
    {
        return Subject::query()
            ->with('department');
    }

    public function findById(int $id): ?Subject
    {
        return Subject::query()
            ->with('department')
            ->find($id);
    }

    public function getActive(): Collection
    {
        return Subject::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();
    }
}
