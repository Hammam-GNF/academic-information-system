<?php

namespace App\Services\Contracts;

use App\Models\Semester;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\JsonResponse;

interface SemesterServiceInterface
{
    public function query(): Builder;

    public function findById(int $id): ?Semester;

    public function getActive(): ?Semester;

    public function index(Request $request): View|JsonResponse;

    public function create(array $data): Semester;

    public function update(
        Semester $semester,
        array $data
    ): Semester;

    public function delete(Semester $semester): bool;
}
