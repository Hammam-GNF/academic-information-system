<?php

namespace App\Services\Contracts;

use App\Models\AcademicYear;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\JsonResponse;

interface AcademicYearServiceInterface
{
    public function query(): Builder;

    public function findById(int $id): ?AcademicYear;

    public function getActive(): ?AcademicYear;

    public function index(Request $request): View|JsonResponse;

    public function create(array $data): AcademicYear;

    public function update(
        AcademicYear $academicYear,
        array $data
    ): AcademicYear;

    public function delete(AcademicYear $academicYear): bool;
}
