<?php

namespace App\Services;

use App\Exports\UsersExport;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

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

    public function create(array $data): RedirectResponse
    {
        $role = $data['role'] ?? null;

        unset($data['role']);

        /** @var User $user */
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

        return Redirect::route('admin.users.index')
            ->with(
                'success',
                'User created successfully.'
            );
    }

    public function update(User $user, array $data): RedirectResponse
    {
        $role = $data['role'] ?? null;

        unset($data['role']);

        $updated = $this->userRepository->update(
            $user,
            $data
        );

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

        return Redirect::route('admin.users.index')
            ->with(
                'success',
                'User updated successfully.'
            );
    }

    public function updatePassword(User $user, string $password): RedirectResponse
    {
        $updated = $this->userRepository->update(
            $user,
            [
                'password' => Hash::make($password),
            ]
        );

        activity()
            ->causedBy(Auth::user())
            ->performedOn($updated)
            ->event('updated')
            ->withProperties([
                'name' => $updated->name,
                'email' => $updated->email,
            ])
            ->log('Password has been updated.');

        return Redirect::route('admin.users.index')
            ->with(
                'success',
                'Password updated successfully.'
            );
    }

    public function restore(int $id): RedirectResponse
    {
        $user = $this->userRepository
            ->findTrashedById($id);

        if (! $user) {
            abort(404);
        }

        $this->userRepository->restore($user);

        activity()
            ->causedBy(Auth::user())
            ->performedOn($user)
            ->event('restored')
            ->log('User has been restored.');

        return back()->with(
            'success',
            'User restored successfully.'
        );
    }

    public function forceDelete(int $id): RedirectResponse
    {
        $user = $this->userRepository
            ->findTrashedById($id);

        if (! $user) {
            abort(404);
        }

        activity()
            ->causedBy(Auth::user())
            ->performedOn($user)
            ->event('force deleted')
            ->log('User has been force deleted.');

        $this->userRepository
            ->forceDelete($user);

        return back()->with(
            'success',
            'User force deleted successfully.'
        );
    }

    public function delete(User $user): RedirectResponse
    {
        try {

            if ($user->id === Auth::id()) {
                throw new \RuntimeException(
                    'You cannot delete your own account.'
                );
            }

            if (
                $user->hasRole('admin')
                && $this->userRepository->getAdminsCount() === 1
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

            return Redirect::route('admin.users.index')
                ->with(
                    'success',
                    'User deleted successfully.'
                );

        } catch (\RuntimeException $e) {

            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }

    public function index(Request $request): View|JsonResponse
    {
        if ($request->ajax()) {

            $users = $this->query();

            if ($request->filled('role')) {
                $users->role($request->role);
            }

            return DataTables::of($users)
                ->addIndexColumn()

                ->addColumn('role', function ($user) {
                    return $user->roles->first()?->name ?? '-';
                })

                ->addColumn('action', function ($user) {

                    $buttons = '
                        <div class="flex gap-2">
                    ';

                    $buttons .= '
                        <a href="'.route('admin.users.edit', $user).'"
                            class="px-3 py-1 bg-blue-600 text-white rounded">
                            Edit
                        </a>
                    ';

                    $buttons .= '
                        <a href="'.route('admin.users.change-password', $user).'"
                            class="px-3 py-1 bg-green-600 text-white rounded">
                            Password
                        </a>
                    ';

                    if (Auth::id() !== $user->id) {

                        $buttons .= '
                            <button
                                type="button"
                                class="delete-user-btn px-3 py-1 bg-red-600 text-white rounded"
                                data-url="'.route('admin.users.destroy', $user).'">
                                Delete
                            </button>
                        ';
                    }

                    $buttons .= '</div>';

                    return $buttons;
                })

                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.users.index');
    }

    public function trash(Request $request): View|JsonResponse
    {
        if ($request->ajax()) {

            $users = $this->userRepository->queryTrashed();

            return DataTables::of($users)

                ->addIndexColumn()

                ->addColumn('role', function ($user) {
                    return $user->roles->first()?->name ?? 'N/A';
                })

                ->editColumn('deleted_at', function ($user) {
                    return $user->deleted_at->format('Y-m-d H:i:s');
                })

                ->addColumn('action', function ($user) {

                    return '
                        <div class="flex gap-2">

                            <button
                                type="button"
                                class="restore-user-btn px-3 py-1 bg-green-600 text-white rounded"
                                data-url="'.route('admin.users.restore', $user).'">
                                Restore
                            </button>

                            <button
                                type="button"
                                class="force-delete-btn px-3 py-1 bg-red-600 text-white rounded"
                                data-url="'.route('admin.users.force-delete', $user).'">
                                Force Delete
                            </button>

                        </div>
                    ';
                })

                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.users.trash');
    }

    public function getAdminsCount(): int
    {
        return $this->userRepository->getAdminsCount();
    }

    public function export(): BinaryFileResponse
    {
        return Excel::download(
            new UsersExport,
            'users.xlsx'
        );
    }
}
