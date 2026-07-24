<?php

namespace App\Services\Contracts;

use App\Models\Department;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\JsonResponse;

interface DepartmentServiceInterface
{
    public function query(): Builder;

    public function findById(int $id): ?Department;

    public function getActive(): Collection;

    public function index(Request $request): View|JsonResponse;

    public function create(array $data): RedirectResponse;

    public function update(
        Department $department,
        array $data
    ): RedirectResponse;

    public function delete(
        Department $department
    ): RedirectResponse;
}
