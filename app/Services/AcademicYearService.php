<?php

namespace App\Services;

use App\Models\AcademicYear;
use App\Repositories\Contracts\AcademicYearRepositoryInterface;
use App\Services\Contracts\AcademicYearServiceInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class AcademicYearService implements AcademicYearServiceInterface
{
    public function __construct(
        protected AcademicYearRepositoryInterface $academicYearRepository,
    ) {}

    public function query(): Builder
    {
        return $this->academicYearRepository->query();
    }

    public function findById(int $id): ?AcademicYear
    {
        return $this->academicYearRepository->findById($id);
    }

    public function getActive(): ?AcademicYear
    {
        return $this->academicYearRepository->getActive();
    }

    public function index(Request $request): View|JsonResponse
    {
        if ($request->ajax()) {

            return DataTables::of(
                $this->academicYearRepository->query()
            )
                ->addIndexColumn()

                ->editColumn('is_active', function ($academicYear) {

                    return $academicYear->is_active
                        ? 'Active'
                        : 'Inactive';

                })

                ->addColumn('action', function ($academicYear) {

                    return view(
                        'admin.academic-years.datatables.actions',
                        compact('academicYear')
                    )->render();

                })

                ->rawColumns([
                    'action',
                ])
                ->make(true);
        }

        return view('admin.academic-years.index');
    }

    public function create(array $data): RedirectResponse
    {
        $academicYear = $this->academicYearRepository->create($data);

        activity()
            ->causedBy(Auth::user())
            ->performedOn($academicYear)
            ->event('created')
            ->withProperties([
                'name' => $academicYear->name,
            ])
            ->log('Academic year has been created.');

        return Redirect::route('admin.academic-years.index')
            ->with(
                'success',
                'Academic year created successfully.'
            );
    }

    public function update(
        AcademicYear $academicYear,
        array $data
    ): RedirectResponse {

        $updated = $this->academicYearRepository->update(
            $academicYear,
            $data
        );

        activity()
            ->causedBy(Auth::user())
            ->performedOn($updated)
            ->event('updated')
            ->withProperties([
                'name' => $updated->name,
            ])
            ->log('Academic year has been updated.');

        return Redirect::route('admin.academic-years.index')
            ->with(
                'success',
                'Academic year updated successfully.'
            );
    }

    public function delete(
        AcademicYear $academicYear
    ): RedirectResponse {

        activity()
            ->causedBy(Auth::user())
            ->performedOn($academicYear)
            ->event('deleted')
            ->withProperties([
                'name' => $academicYear->name,
            ])
            ->log('Academic year has been deleted.');

        $this->academicYearRepository->delete(
            $academicYear
        );

        return Redirect::route('admin.academic-years.index')
            ->with(
                'success',
                'Academic year deleted successfully.'
            );
    }
}
