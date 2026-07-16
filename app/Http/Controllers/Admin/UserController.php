<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserPasswordRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use App\Services\Contracts\UserServiceInterface;

class UserController extends Controller
{
    public function __construct(
        protected UserServiceInterface $userService,
    ) {}
    public function index(Request $request)
    {
        $this->authorize('viewAny', User::class);

        if ($request->ajax()) {

            $users = $this->userService->query();

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
                                data-url="'.route('admin.users.destroy', $user).'"
                            >
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

    public function create()
    {
        $this->authorize('create', User::class);

        return view('admin.users.create');
    }

    public function store(StoreUserRequest $request)
    {
        $this->authorize('create', User::class);

        $this->userService->create(
            $request->validated()
        );

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);

        return view('admin.users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $this->userService->update(
            $user,
            $request->validated()
        );

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }

    public function changePassword(User $user)
    {
        $this->authorize('update', $user);

        return view('admin.users.change-password', compact('user'));
    }

    public function updatePassword(UpdateUserPasswordRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $user->update([
            'password' => Hash::make($request->validated()['password']),
        ]);

        activity()
            ->causedBy(Auth::user())
            ->performedOn($user)
            ->event('updated')
            ->withProperties(['name' => $user->name, 'email' => $user->email])
            ->log('Password has been updated.');

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Password updated successfully.');
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function trash(Request $request)
    {
        $this->authorize('viewAny', User::class);

        if ($request->ajax()) {
            $users = User::onlyTrashed()->with('roles')->latest();

            return DataTables::of($users)
                ->addIndexColumn()

                ->addColumn('role', function ($user) {
                    return $user->roles->first()?->name ?? 'N/A';
                })

                ->editColumn('deleted_at', function ($user) {
                    return $user->deleted_at->format('Y-m-d H:i:s');
                })

                ->addColumn('action', function ($user) {
                    $buttons = '
                        <div class="flex gap-2">
                    ';

                    $buttons .= '
                        <button
                            type="button"
                            class="restore-user-btn px-3 py-1 bg-green-600 text-white rounded"
                            data-url="'.route('admin.users.restore', $user).'"
                        >
                            Restore
                        </button>
                    ';

                    $buttons .= '
                        <button
                            type="button"
                            class="force-delete-btn px-3 py-1 bg-red-600 text-white rounded"
                            data-url="'.route('admin.users.force-delete', $user).'"
                        >
                            Force Delete
                        </button>
                    ';

                    $buttons .= '</div>';

                    return $buttons;
                })

                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.users.trash');
    }

    public function restore($id)
    {
        $this->userService->restore($id);

        return back()->with(
            'success',
            'User restored successfully.'
        );
    }

    public function forceDelete($id)
    {
        $this->userService->forceDelete($id);

        return back()->with(
            'success',
            'User force deleted successfully.'
        );
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        try {

            $this->userService->delete($user);

            return redirect()
                ->route('admin.users.index')
                ->with('success', 'User deleted successfully.');

        } catch (\RuntimeException $e) {

            return back()->with('error', $e->getMessage());

        }
    }
}
