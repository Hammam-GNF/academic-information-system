<?php

namespace App\Repositories\Contracts;

use App\Models\AcademicYear;
use Illuminate\Database\Eloquent\Builder;

interface AcademicYearRepositoryInterface extends BaseRepositoryInterface
{
    public function query(): Builder;

    public function findById(int $id): ?AcademicYear;

    public function getActive(): ?AcademicYear;
}
