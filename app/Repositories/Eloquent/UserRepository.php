<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function query(): Builder
    {
        return $this->model->newQuery()->with('roles');
    }

    public function getAllWithRoles(): Collection
    {
        return $this->query()->get();
    }

    public function getPaginatedWithRoles(int $perPage = 15): LengthAwarePaginator
    {
        return $this->query()->paginate($perPage);
    }

    public function findById(int $id): ?User
    {
        return $this->query()->find($id);
    }

    public function findByEmail(string $email): ?User
    {
        return $this->query()
            ->where('email', $email)
            ->first();
    }

    public function getAdminsCount(): int
    {
        return $this->query()
            ->role('admin')
            ->count();
    }

    public function findTrashedById(int $id): ?User
    {
        return $this->model
            ->onlyTrashed()
            ->with('roles')
            ->find($id);
    }

    public function queryTrashed(): Builder
    {
        return $this->model
            ->onlyTrashed()
            ->with('roles')
            ->latest();
    }
}
