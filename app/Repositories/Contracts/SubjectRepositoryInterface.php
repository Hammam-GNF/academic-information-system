<?php

namespace App\Repositories\Contracts;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

interface SubjectRepositoryInterface
{
    public function query(): Builder;

    public function findById(int $id): ?Subject;

    public function getActive(): Collection;
}
