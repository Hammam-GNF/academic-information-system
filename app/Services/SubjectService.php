<?php

namespace App\Services;

use App\Models\Subject;
use App\Repositories\Contracts\SubjectRepositoryInterface;
use App\Services\Contracts\SubjectServiceInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SubjectService implements SubjectServiceInterface
{
    public function __construct(
        protected SubjectRepositoryInterface $subjectRepository,
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
                    fn (Subject $subject) => $subject->department->name
                )

                ->editColumn(
                    'credit_hours',
                    fn (Subject $subject) => $subject->credit_hours.' SKS'
                )

                ->editColumn(
                    'is_active',
                    fn (Subject $subject) => view(
                        'components.badges.status',
                        [
                            'active' => $subject->is_active,
                        ]
                    )
                )

                ->addColumn(
                    'action',
                    fn (Subject $subject) => view(
                        'admin.subjects.datatables.actions',
                        compact('subject')
                    )
                )

                ->rawColumns([
                    'is_active',
                    'action',
                ])

                ->make(true);
        }

        return view(
            'admin.subjects.index'
        );
    }

    public function create(
        array $data
    ): RedirectResponse {

        Subject::create($data);

        return redirect()
            ->route('admin.subjects.index')
            ->with(
                'success',
                'Subject created successfully.'
            );
    }

    public function update(
        Subject $subject,
        array $data
    ): RedirectResponse {

        $subject->update($data);

        return redirect()
            ->route('admin.subjects.index')
            ->with(
                'success',
                'Subject updated successfully.'
            );
    }

    public function delete(
        Subject $subject
    ): RedirectResponse {

        $subject->delete();

        return redirect()
            ->route('admin.subjects.index')
            ->with(
                'success',
                'Subject deleted successfully.'
            );
    }

    public function query(): Builder
    {
        return $this->subjectRepository
            ->query()
            ->with('department');
    }

    public function findById(int $id): ?Subject
    {
        return $this->subjectRepository->findById($id);
    }

    public function getActive(): Collection
    {
        return $this->subjectRepository->getActive();
    }
}
