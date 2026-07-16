<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
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

        activity()
            ->causedBy(Auth::user())
            ->performedOn($user)
            ->event('created')
            ->withProperties([
                'name' => $user->name,
                'email' => $user->email,
            ])
            ->log('User has been created.');

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

        activity()
            ->causedBy(Auth::user())
            ->performedOn($updated)
            ->event('updated')
            ->withProperties([
                'name' => $updated->name,
                'email' => $updated->email,
            ])
            ->log('User has been updated.');

        return $updated;
    }

    public function delete(User $user): void
    {
        if ($user->id === Auth::id()) {
            throw new \RuntimeException(
                'You cannot delete your own account.'
            );
        }

        if (
            $user->hasRole('admin') &&
            $this->userRepository->getAdminsCount() === 1
        ) {
            throw new \RuntimeException(
                'You cannot delete the last admin account.'
            );
        }

        activity()
            ->causedBy(Auth::user())
            ->performedOn($user)
            ->event('deleted')
            ->withProperties([
                'name' => $user->name,
                'email' => $user->email,
            ])
            ->log('User has been deleted.');

        $this->userRepository->delete($user);
    }

    public function restore(int $id): void
    {
        $user = $this->userRepository->findTrashedById($id);

        if (! $user) {
            abort(404);
        }

        $this->userRepository->restore($user);

        activity()
            ->causedBy(Auth::user())
            ->performedOn($user)
            ->event('restored')
            ->log('User has been restored.');
    }

    public function forceDelete(int $id): void
    {
        $user = $this->userRepository->findTrashedById($id);

        if (! $user) {
            abort(404);
        }

        activity()
            ->causedBy(Auth::user())
            ->performedOn($user)
            ->event('force deleted')
            ->log('User has been force deleted.');

        $this->userRepository->forceDelete($user);
    }

    public function updatePassword(User $user, string $password): User
    {
        $updated = $this->userRepository->update($user, [
            'password' => Hash::make($password),
        ]);

        activity()
            ->causedBy(Auth::user())
            ->performedOn($updated)
            ->event('updated')
            ->withProperties([
                'name' => $updated->name,
                'email' => $updated->email,
            ])
            ->log('Password has been updated.');

        return $updated;
    }
    public function getAdminsCount(): int
    {
        return $this->userRepository->getAdminsCount();
    }
}
