<?php

namespace App\Services\Contracts;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface UserServiceInterface
{
    public function query(): Builder;

    public function getAllWithRoles(): Collection;

    public function getPaginatedWithRoles(int $perPage = 15): LengthAwarePaginator;

    public function findById(int $id): ?User;

    public function findByEmail(string $email): ?User;

    public function create(array $data): User;

    public function update(User $user, array $data): User;

    public function delete(User $user): void;

    public function restore(int $id): void;

    public function forceDelete(int $id): void;

    public function updatePassword(User $user, string $password): User;

    public function getAdminsCount(): int;
}
