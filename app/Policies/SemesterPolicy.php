<?php

namespace App\Policies;

use App\Models\Semester;
use App\Models\User;

class SemesterPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasRole('admin');
    }

    public function view(User $user, Semester $semester): bool
    {
        return $user->hasRole('admin');
    }

    public function create(User $user): bool
    {
        return $user->hasRole('admin');
    }

    public function update(User $user, Semester $semester): bool
    {
        return $user->hasRole('admin');
    }

    public function delete(User $user, Semester $semester): bool
    {
        return $user->hasRole('admin');
    }

    public function restore(User $user, Semester $semester): bool
    {
        return $user->hasRole('admin');
    }

    public function forceDelete(User $user, Semester $semester): bool
    {
        return $user->hasRole('admin');
    }
}
