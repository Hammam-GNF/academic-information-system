<?php

namespace App\Services\Contracts;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

interface SubjectServiceInterface
{
    public function query(): Builder;

    public function findById(int $id): ?Subject;

    public function getActive(): Collection;
}
