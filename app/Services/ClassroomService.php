<?php

namespace App\Services;

use App\Models\Classroom;
use App\Repositories\Contracts\ClassroomRepositoryInterface;
use App\Services\Contracts\ClassroomServiceInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ClassroomService implements ClassroomServiceInterface
{
    public function __construct(
        protected ClassroomRepositoryInterface $classroomRepository,
    ) {}

    public function index(Request $request)
    {
        if ($request->ajax()) {

            return DataTables::of(
                $this->query()
            )

                ->addIndexColumn()

                ->editColumn(
                    'department',
                    fn (Classroom $classroom) => $classroom->department->name
                )

                ->editColumn(
                    'grade',
                    fn (Classroom $classroom) => $classroom->grade->name
                )

                ->editColumn(
                    'capacity',
                    fn (Classroom $classroom) => number_format($classroom->capacity)
                )

                ->editColumn(
                    'is_active',
                    fn (Classroom $classroom) => view(
                        'components.badges.status',
                        [
                            'active' => $classroom->is_active,
                        ]
                    )
                )

                ->addColumn(
                    'action',
                    fn (Classroom $classroom) => view(
                        'admin.classrooms.datatables.actions',
                        compact('classroom')
                    )
                )

                ->rawColumns([
                    'is_active',
                    'action',
                ])

                ->make(true);
        }

        return view(
            'admin.classrooms.index'
        );
    }

    public function create(array $data): RedirectResponse
    {
        Classroom::create($data);

        return redirect()
            ->route('admin.classrooms.index')
            ->with(
                'success',
                'Classroom created successfully.'
            );
    }

    public function update(
        Classroom $classroom,
        array $data
    ): RedirectResponse {

        $classroom->update($data);

        return redirect()
            ->route('admin.classrooms.index')
            ->with(
                'success',
                'Classroom updated successfully.'
            );
    }

    public function delete(
        Classroom $classroom
    ): RedirectResponse {

        $classroom->delete();

        return redirect()
            ->route('admin.classrooms.index')
            ->with(
                'success',
                'Classroom deleted successfully.'
            );
    }

    public function query(): Builder
    {
        return $this->classroomRepository->query();
    }

    public function findById(int $id): ?Classroom
    {
        return $this->classroomRepository->findById($id);
    }

    public function getActive(): Collection
    {
        return $this->classroomRepository->getActive();
    }
}
