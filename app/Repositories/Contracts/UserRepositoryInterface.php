<?php

namespace App\Repositories\Contracts;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function query(): Builder;

    public function getAllWithRoles(): Collection;

    public function getPaginatedWithRoles(int $perPage = 15): LengthAwarePaginator;

    public function findById(int $id): ?User;

    public function findByEmail(string $email): ?User;

    public function getAdminsCount(): int;

    public function findTrashedById(int $id): ?User;

    public function queryTrashed(): Builder;
}
