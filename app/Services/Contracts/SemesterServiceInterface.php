<?php

namespace App\Services\Contracts;

use App\Models\Semester;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\JsonResponse;

interface SemesterServiceInterface
{
    public function query(): Builder;

    public function findById(int $id): ?Semester;

    public function getActive(): Collection;

    public function index(
        Request $request
    ): View|JsonResponse;

    public function create(
        array $data
    ): RedirectResponse;

    public function update(
        Semester $semester,
        array $data
    ): RedirectResponse;

    public function delete(
        Semester $semester
    ): RedirectResponse;
}
