<?php

namespace App\Services;

use App\Models\Classroom;
use App\Repositories\Contracts\ClassroomRepositoryInterface;
use App\Services\Contracts\ClassroomServiceInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class ClassroomService implements ClassroomServiceInterface
{
    public function __construct(
        protected ClassroomRepositoryInterface $classroomRepository,
    ) {}

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

    public function index(Request $request): View|JsonResponse
    {
        if ($request->ajax()) {

            return DataTables::of(
                $this->query()
            )
                ->addIndexColumn()

                ->editColumn(
                    'department',
                    fn (Classroom $classroom)
                        => $classroom->department?->name ?? '-'
                )

                ->editColumn(
                    'grade',
                    fn (Classroom $classroom)
                        => $classroom->grade?->name ?? '-'
                )

                ->editColumn(
                    'capacity',
                    fn (Classroom $classroom)
                        => number_format($classroom->capacity)
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
                    )->render()
                )

                ->rawColumns([
                    'is_active',
                    'action',
                ])

                ->make(true);
        }

        return view('admin.classrooms.index');
    }

    public function create(array $data): RedirectResponse
    {
        $classroom = $this->classroomRepository->create($data);

        activity()
            ->causedBy(Auth::user())
            ->performedOn($classroom)
            ->event('created')
            ->withProperties([
                'name' => $classroom->name,
            ])
            ->log('Classroom has been created.');

        return Redirect::route('admin.classrooms.index')
            ->with(
                'success',
                'Classroom created successfully.'
            );
    }

    public function update(
        Classroom $classroom,
        array $data
    ): RedirectResponse {

        $updated = $this->classroomRepository->update(
            $classroom,
            $data
        );

        activity()
            ->causedBy(Auth::user())
            ->performedOn($updated)
            ->event('updated')
            ->withProperties([
                'name' => $updated->name,
            ])
            ->log('Classroom has been updated.');

        return Redirect::route('admin.classrooms.index')
            ->with(
                'success',
                'Classroom updated successfully.'
            );
    }

    public function delete(
        Classroom $classroom
    ): RedirectResponse {

        activity()
            ->causedBy(Auth::user())
            ->performedOn($classroom)
            ->event('deleted')
            ->withProperties([
                'name' => $classroom->name,
            ])
            ->log('Classroom has been deleted.');

        $this->classroomRepository->delete(
            $classroom
        );

        return Redirect::route('admin.classrooms.index')
            ->with(
                'success',
                'Classroom deleted successfully.'
            );
    }
}
