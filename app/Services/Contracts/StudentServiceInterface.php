<?php

namespace App\Services\Contracts;

use App\Models\Student;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\JsonResponse;

interface StudentServiceInterface
{
    public function query(): Builder;

    public function findById(int $id): ?Student;

    public function getActive(): Collection;

    public function findByStudentNumber(
        string $studentNumber
    ): ?Student;

    public function index(
        Request $request
    ): View|JsonResponse;

    public function create(
        array $data
    ): RedirectResponse;

    public function update(
        Student $student,
        array $data
    ): RedirectResponse;

    public function delete(
        Student $student
    ): RedirectResponse;

}
