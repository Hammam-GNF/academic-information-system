<?php

namespace App\Services;

use App\Models\AcademicYear;
use App\Repositories\Contracts\AcademicYearRepositoryInterface;
use App\Services\Contracts\AcademicYearServiceInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
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

                    return '';

                })

                ->rawColumns([
                    'action',
                ])
                ->make(true);
        }

        return view('admin.academic-years.index');
    }

    public function create(array $data): AcademicYear
    {
        return $this->academicYearRepository->create($data);
    }

    public function update(
        AcademicYear $academicYear,
        array $data
    ): AcademicYear {
        return $this->academicYearRepository->update(
            $academicYear,
            $data
        );
    }

    public function delete(AcademicYear $academicYear): bool
    {
        return $this->academicYearRepository->delete($academicYear);
    }
}
