<?php

namespace App\Services;

use App\Models\Semester;
use App\Repositories\Contracts\SemesterRepositoryInterface;
use App\Services\Contracts\SemesterServiceInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
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
                $this->semesterRepository->query()
            )
                ->addIndexColumn()

                ->editColumn('is_active', function ($semester) {

                    return $semester->is_active
                        ? 'Active'
                        : 'Inactive';

                })

                ->addColumn('action', function ($semester) {

                    return '';

                })

                ->rawColumns([
                    'action',
                ])
                ->make(true);
        }

        return view('admin.semesters.index');
    }

    public function create(array $data): Semester
    {
        return $this->semesterRepository->create($data);
    }

    public function update(
        Semester $semester,
        array $data
    ): Semester {
        return $this->semesterRepository->update(
            $semester,
            $data
        );
    }

    public function delete(Semester $semester): bool
    {
        return $this->semesterRepository->delete($semester);
    }
}
