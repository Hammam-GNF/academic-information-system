<?php

namespace App\Services\Contracts;

use App\Models\Grade;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\JsonResponse;

interface GradeServiceInterface
{
    public function query(): Builder;

    public function findById(int $id): ?Grade;

    public function getActive(): Collection;

    public function index(
        Request $request
    ): View|JsonResponse;

    public function create(
        array $data
    ): RedirectResponse;

    public function update(
        Grade $grade,
        array $data
    ): RedirectResponse;

    public function delete(
        Grade $grade
    ): RedirectResponse;
}
