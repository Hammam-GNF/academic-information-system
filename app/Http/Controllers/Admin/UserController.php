<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserPasswordRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\Contracts\UserServiceInterface;

class UserController extends Controller
{
    public function __construct(
        protected UserServiceInterface $userService,
    ) {}

    public function index(Request $request)
    {
        $this->authorize('viewAny', User::class);

        return $this->userService->index($request);
    }

    public function create()
    {
        $this->authorize('create', User::class);

        return view('admin.users.create');
    }

    public function store(StoreUserRequest $request)
    {
        $this->authorize('create', User::class);

        return $this->userService->create(
            $request->validated()
        );
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);

        return view('admin.users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request,User $user)
    {
        $this->authorize('update', $user);

        return $this->userService->update(
            $user,
            $request->validated()
        );
    }

    public function updatePassword(UpdateUserPasswordRequest $request,User $user)
    {
        $this->authorize('update', $user);

        return $this->userService->updatePassword(
            $user,
            $request->validated('password')
        );
    }

    public function restore($id)
    {
        return $this->userService->restore($id);
    }

    public function changePassword(User $user)
    {
        $this->authorize('update', $user);

        return view('admin.users.change-password', compact('user'));
    }

    public function export()
    {
        return $this->userService->export();
    }

    public function trash(Request $request)
    {
        $this->authorize('viewAny', User::class);

        return $this->userService->trash($request);
    }

    public function forceDelete($id)
    {
        return $this->userService->forceDelete($id);
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        return $this->userService->delete($user);
    }
}
