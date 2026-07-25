<?php

namespace App\Services;

use App\Models\Subject;
use App\Repositories\Contracts\SubjectRepositoryInterface;
use App\Services\Contracts\SubjectServiceInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class SubjectService implements SubjectServiceInterface
{
    public function __construct(
        protected SubjectRepositoryInterface $subjectRepository,
    ) {}

    public function query(): Builder
    {
        return $this->subjectRepository->query();
    }


    public function findById(int $id): ?Subject
    {
        return $this->subjectRepository->findById($id);
    }

    public function getActive(): Collection
    {
        return $this->subjectRepository->getActive();
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
                    fn (Subject $subject)
                        => $subject->department?->name ?? '-'
                )

                ->editColumn(
                    'credit_hours',
                    fn (Subject $subject)
                        => $subject->credit_hours . ' SKS'
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
                    )->render()
                )

                ->rawColumns([
                    'is_active',
                    'action',
                ])

                ->make(true);
        }

        return view('admin.subjects.index');
    }

    public function create(
        array $data
    ): RedirectResponse {

        $subject = $this->subjectRepository->create($data);

        activity()
            ->causedBy(Auth::user())
            ->performedOn($subject)
            ->event('created')
            ->withProperties([
                'code' => $subject->code,
                'name' => $subject->name,
            ])
            ->log('Subject has been created.');

        return Redirect::route('admin.subjects.index')
            ->with(
                'success',
                'Subject created successfully.'
            );
    }

    public function update(
        Subject $subject,
        array $data
    ): RedirectResponse {

        $updated = $this->subjectRepository->update(
            $subject,
            $data
        );

        activity()
            ->causedBy(Auth::user())
            ->performedOn($updated)
            ->event('updated')
            ->withProperties([
                'code' => $updated->code,
                'name' => $updated->name,
            ])
            ->log('Subject has been updated.');

        return Redirect::route('admin.subjects.index')
            ->with(
                'success',
                'Subject updated successfully.'
            );
    }

    public function delete(
        Subject $subject
    ): RedirectResponse {

        activity()
            ->causedBy(Auth::user())
            ->performedOn($subject)
            ->event('deleted')
            ->withProperties([
                'code' => $subject->code,
                'name' => $subject->name,
            ])
            ->log('Subject has been deleted.');

        $this->subjectRepository->delete(
            $subject
        );

        return Redirect::route('admin.subjects.index')
            ->with(
                'success',
                'Subject deleted successfully.'
            );
    }
}
