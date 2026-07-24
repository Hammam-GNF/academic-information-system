<?php

namespace App\Services\Contracts;

use App\Models\Grade;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

interface GradeServiceInterface
{
    public function query(): Builder;

    public function findById(int $id): ?Grade;

    public function getActive(): Collection;
}
