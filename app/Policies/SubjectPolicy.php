<?php

namespace App\Policies;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SubjectPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasRole('admin');
    }

    public function view(User $user, Subject $subject): bool
    {
        return $user->hasRole('admin');
    }

    public function create(User $user): bool
    {
        return $user->hasRole('admin');
    }

    public function update(User $user, Subject $subject): bool
    {
        return $user->hasRole('admin');
    }

    public function delete(User $user, Subject $subject): bool
    {
        return $user->hasRole('admin');
    }

    public function restore(User $user, Subject $subject): bool
    {
        return $user->hasRole('admin');
    }

    public function forceDelete(User $user, Subject $subject): bool
    {
        return $user->hasRole('admin');
    }
}
