<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{
    public function __construct(
        protected UserRepositoryInterface $userRepository,
    ) {}

    public function query(): Builder
    {
        return $this->userRepository->query();
    }

    public function getAllWithRoles(): Collection
    {
        return $this->userRepository->getAllWithRoles();
    }

    public function getPaginatedWithRoles(int $perPage = 15): LengthAwarePaginator
    {
        return $this->userRepository->getPaginatedWithRoles($perPage);
    }

    public function findById(int $id): ?User
    {
        return $this->userRepository->findById($id);
    }

    public function findByEmail(string $email): ?User
    {
        return $this->userRepository->findByEmail($email);
    }

    public function create(array $data): User
    {
        $role = $data['role'] ?? null;

        unset($data['role']);

        $user = $this->userRepository->create($data);

        if ($role) {
            $user->assignRole($role);
        }

        return $user;
    }

    public function update(User $user, array $data): User
    {
        $role = $data['role'] ?? null;

        unset($data['role']);

        $updated = $this->userRepository->update($user, $data);

        if ($role) {
            $updated->syncRoles($role);
        }

        return $updated;
    }

    public function delete(User $user): bool
    {
        return $this->userRepository->delete($user);
    }

    public function restore(User $user): bool
    {
        return $this->userRepository->restore($user);
    }

    public function forceDelete(User $user): bool
    {
        return $this->userRepository->forceDelete($user);
    }

    public function updatePassword(User $user, string $password): User
    {
        return $this->userRepository->update($user, [
            'password' => Hash::make($password),
        ]);
    }
    public function getAdminsCount(): int
    {
        return $this->userRepository->getAdminsCount();
    }
}
