<?php

namespace App\Services\Contracts;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\JsonResponse;

interface UserServiceInterface
{
    public function query(): Builder;

    public function getAllWithRoles(): Collection;

    public function getPaginatedWithRoles(int $perPage = 15): LengthAwarePaginator;

    public function findById(int $id): ?User;

    public function findByEmail(string $email): ?User;

    public function create(array $data): RedirectResponse;

    public function update(
        User $user,
        array $data
    ): RedirectResponse;

    public function updatePassword(
        User $user,
        string $password
    ): RedirectResponse;

    public function delete(User $user): RedirectResponse;

    public function restore(int $id): RedirectResponse;

    public function forceDelete(int $id): RedirectResponse;

    public function index(Request $request): View|JsonResponse;

    public function trash(Request $request): View|JsonResponse;

    public function export(): BinaryFileResponse;

    public function getAdminsCount(): int;
}
