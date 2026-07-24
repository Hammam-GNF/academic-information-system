<?php

namespace App\Services\Contracts;

use App\Models\Classroom;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

interface ClassroomServiceInterface
{
    public function index(Request $request);

    public function create(array $data): RedirectResponse;

    public function update(
        Classroom $classroom,
        array $data
    ): RedirectResponse;

    public function delete(
        Classroom $classroom
    ): RedirectResponse;

    public function query(): Builder;

    public function findById(int $id): ?Classroom;

    public function getActive(): Collection;
}
