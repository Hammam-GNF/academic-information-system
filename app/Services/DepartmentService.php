<?php

namespace App\Services;

use App\Models\Department;
use App\Repositories\Contracts\DepartmentRepositoryInterface;
use App\Services\Contracts\DepartmentServiceInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class DepartmentService implements DepartmentServiceInterface
{
    public function __construct(
        protected DepartmentRepositoryInterface $departmentRepository,
    ) {}

    public function query(): Builder
    {
        return $this->departmentRepository->query();
    }

    public function findById(int $id): ?Department
    {
        return $this->departmentRepository->findById($id);
    }

    public function getActive(): Collection
    {
        return $this->departmentRepository->getActive();
    }

    public function index(Request $request): View|JsonResponse
    {
        if ($request->ajax()) {

            return DataTables::of(
                $this->query()
            )
                ->addIndexColumn()

                ->editColumn(
                    'is_active',
                    fn (Department $department)
                        => view(
                            'components.badges.status',
                            [
                                'active' => $department->is_active,
                            ]
                        )
                )

                ->addColumn('action', function ($department) {

                    return view(
                        'admin.departments.datatables.actions',
                        compact('department')
                    )->render();

                })

                ->rawColumns([
                    'action',
                ])

                ->make(true);
        }

        return view('admin.departments.index');
    }

    public function create(array $data): RedirectResponse
    {
        $department = $this->departmentRepository->create($data);

        activity()
            ->causedBy(Auth::user())
            ->performedOn($department)
            ->event('created')
            ->withProperties([
                'code' => $department->code,
                'name' => $department->name,
            ])
            ->log('Department has been created.');

        return Redirect::route('admin.departments.index')
            ->with(
                'success',
                'Department created successfully.'
            );
    }

    public function update(
        Department $department,
        array $data
    ): RedirectResponse {

        $department = $this->departmentRepository->update(
            $department,
            $data
        );

        activity()
            ->causedBy(Auth::user())
            ->performedOn($department)
            ->event('updated')
            ->withProperties([
                'code' => $department->code,
                'name' => $department->name,
            ])
            ->log('Department has been updated.');

        return Redirect::route('admin.departments.index')
            ->with(
                'success',
                'Department updated successfully.'
            );
    }

    public function delete(
        Department $department
    ): RedirectResponse {

        activity()
            ->causedBy(Auth::user())
            ->performedOn($department)
            ->event('deleted')
            ->withProperties([
                'code' => $department->code,
                'name' => $department->name,
            ])
            ->log('Department has been deleted.');

        $this->departmentRepository->delete(
            $department
        );

        return Redirect::route('admin.departments.index')
            ->with(
                'success',
                'Department deleted successfully.'
            );
    }
}
