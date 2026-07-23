<?php

namespace App\Repositories\Contracts;

use App\Models\Semester;
use Illuminate\Database\Eloquent\Builder;

interface SemesterRepositoryInterface extends BaseRepositoryInterface
{
    public function query(): Builder;

    public function findById(int $id): ?Semester;

    public function getActive(): ?Semester;
}
