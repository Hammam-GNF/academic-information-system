<?php

namespace App\Services;

use App\Models\Grade;
use App\Repositories\Contracts\GradeRepositoryInterface;
use App\Services\Contracts\GradeServiceInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class GradeService implements GradeServiceInterface
{
    public function __construct(
        protected GradeRepositoryInterface $gradeRepository,
    ) {}

    public function query(): Builder
    {
        return $this->gradeRepository->query();
    }

    public function findById(int $id): ?Grade
    {
        return $this->gradeRepository->findById($id);
    }

    public function getActive(): Collection
    {
        return $this->gradeRepository->getActive();
    }

    public function index(Request $request): View|JsonResponse
    {
        if ($request->ajax()) {

            return DataTables::of(
                $this->query()
            )
                ->addIndexColumn()

                ->editColumn('is_active', function ($grade) {

                    return $grade->is_active
                        ? 'Active'
                        : 'Inactive';

                })

                ->addColumn('action', function ($grade) {

                    return view(
                        'admin.grades.datatables.actions',
                        compact('grade')
                    )->render();

                })

                ->rawColumns([
                    'action',
                ])
                ->make(true);
        }

        return view('admin.grades.index');
    }

    public function create(array $data): RedirectResponse
    {
        $grade = $this->gradeRepository->create($data);

        activity()
            ->causedBy(Auth::user())
            ->performedOn($grade)
            ->event('created')
            ->withProperties([
                'code' => $grade->code,
                'name' => $grade->name,
            ])
            ->log('Grade has been created.');

        return Redirect::route('admin.grades.index')
            ->with(
                'success',
                'Grade created successfully.'
            );
    }

    public function update(
        Grade $grade,
        array $data
    ): RedirectResponse {

        $grade = $this->gradeRepository->update(
            $grade,
            $data
        );

        activity()
            ->causedBy(Auth::user())
            ->performedOn($grade)
            ->event('updated')
            ->withProperties([
                'code' => $grade->code,
                'name' => $grade->name,
            ])
            ->log('Grade has been updated.');

        return Redirect::route('admin.grades.index')
            ->with(
                'success',
                'Grade updated successfully.'
            );
    }

    public function delete(
        Grade $grade
    ): RedirectResponse {

        activity()
            ->causedBy(Auth::user())
            ->performedOn($grade)
            ->event('deleted')
            ->withProperties([
                'code' => $grade->code,
                'name' => $grade->name,
            ])
            ->log('Grade has been deleted.');

        $this->gradeRepository->delete($grade);

        return Redirect::route('admin.grades.index')
            ->with(
                'success',
                'Grade deleted successfully.'
            );
    }
}
