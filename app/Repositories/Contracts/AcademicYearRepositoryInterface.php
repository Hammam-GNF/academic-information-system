<?php

namespace App\Repositories\Contracts;

use App\Models\AcademicYear;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

interface AcademicYearRepositoryInterface extends BaseRepositoryInterface
{
    public function query(): Builder;

    public function findById(int $id): ?AcademicYear;

    public function getActive(): Collection;
}
