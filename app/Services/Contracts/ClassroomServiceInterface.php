<?php

namespace App\Services\Contracts;

use App\Models\Classroom;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

interface ClassroomServiceInterface
{
    public function query(): Builder;

    public function findById(int $id): ?Classroom;

    public function getActive(): Collection;
}
