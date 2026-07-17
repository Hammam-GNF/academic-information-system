<?php

namespace App\Services\Contracts;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\RedirectResponse;

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

    public function getAdminsCount(): int;
}
