<?php

namespace App\Policies;

use App\Models\Classroom;
use App\Models\User;

class ClassroomPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasRole('admin');
    }

    public function view(User $user, Classroom $classroom): bool
    {
        return $user->hasRole('admin');
    }

    public function create(User $user): bool
    {
        return $user->hasRole('admin');
    }

    public function update(User $user, Classroom $classroom): bool
    {
        return $user->hasRole('admin');
    }

    public function delete(User $user, Classroom $classroom): bool
    {
        return $user->hasRole('admin');
    }

    public function restore(User $user, Classroom $classroom): bool
    {
        return $user->hasRole('admin');
    }

    public function forceDelete(User $user, Classroom $classroom): bool
    {
        return $user->hasRole('admin');
    }
}
