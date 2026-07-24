<?php

namespace App\Services;

use App\Models\Semester;
use App\Repositories\Contracts\SemesterRepositoryInterface;
use App\Services\Contracts\SemesterServiceInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class SemesterService implements SemesterServiceInterface
{
    public function __construct(
        protected SemesterRepositoryInterface $semesterRepository,
    ) {}

    public function query(): Builder
    {
        return $this->semesterRepository->query();
    }

    public function findById(int $id): ?Semester
    {
        return $this->semesterRepository->findById($id);
    }

    public function getActive(): ?Semester
    {
        return $this->semesterRepository->getActive();
    }

    public function index(Request $request): View|JsonResponse
    {
        if ($request->ajax()) {

            return DataTables::of(
                $this->query()
            )
                ->addIndexColumn()

                ->addColumn('academic_year', function ($semester) {
                    return $semester->academicYear?->name ?? '-';
                })

                ->editColumn('status', function ($semester) {
                    return $semester->is_active
                        ? 'Active'
                        : 'Inactive';
                })

                ->addColumn('action', function ($semester) {
                    return view(
                        'admin.semesters.datatables.actions',
                        compact('semester')
                    )->render();
                })

                ->rawColumns([
                    'action',
                ])
                ->make(true);
        }

        return view('admin.semesters.index');
    }

    public function create(array $data): RedirectResponse
    {
        $semester = $this->semesterRepository->create($data);

        activity()
            ->causedBy(Auth::user())
            ->performedOn($semester)
            ->event('created')
            ->withProperties([
                'name' => $semester->name,
            ])
            ->log('Semester has been created.');

        return Redirect::route('admin.semesters.index')
            ->with(
                'success',
                'Semester created successfully.'
            );
    }

    public function update(
        Semester $semester,
        array $data
    ): RedirectResponse {

        $semester = $this->semesterRepository->update(
            $semester,
            $data
        );

        activity()
            ->causedBy(Auth::user())
            ->performedOn($semester)
            ->event('updated')
            ->withProperties([
                'name' => $semester->name,
            ])
            ->log('Semester has been updated.');

        return Redirect::route('admin.semesters.index')
            ->with(
                'success',
                'Semester updated successfully.'
            );
    }

    public function delete(
        Semester $semester
    ): RedirectResponse {

        activity()
            ->causedBy(Auth::user())
            ->performedOn($semester)
            ->event('deleted')
            ->withProperties([
                'name' => $semester->name,
            ])
            ->log('Semester has been deleted.');

        $this->semesterRepository->delete($semester);

        return Redirect::route('admin.semesters.index')
            ->with(
                'success',
                'Semester deleted successfully.'
            );
    }
}
