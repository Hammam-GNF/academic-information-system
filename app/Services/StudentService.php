<?php

namespace App\Services;

use App\Models\Student;
use App\Repositories\Contracts\StudentRepositoryInterface;
use App\Services\Contracts\StudentServiceInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class StudentService implements StudentServiceInterface
{
    public function __construct(
        protected StudentRepositoryInterface $studentRepository,
    ) {}

    public function query(): Builder
    {
        return $this->studentRepository->query();
    }

    public function findById(int $id): ?Student
    {
        return $this->studentRepository
            ->findById($id);
    }

    public function getActive(): Collection
    {
        return $this->studentRepository
            ->getActive();
    }

    public function findByStudentNumber(
        string $studentNumber
    ): ?Student {

        return $this->studentRepository
            ->findByStudentNumber(
                $studentNumber
            );
    }

    public function index(
        Request $request
    ): View|JsonResponse {

        if ($request->ajax()) {

            return DataTables::of(
                $this->query()
            )

                ->addIndexColumn()

                ->addColumn(
                    'classroom',
                    fn (Student $student)
                        => $student->classroom
                            ? $student->classroom->grade->name.' - '.$student->classroom->name
                            : '-'
                )

                ->editColumn(
                    'gender',
                    fn (Student $student)
                        => ucfirst($student->gender)
                )

                ->editColumn(
                    'is_active',
                    fn (Student $student) => view(
                        'components.badges.status',
                        [
                            'active' => $student->is_active,
                        ]
                    )
                )

                ->addColumn(
                    'action',
                    fn (Student $student) => view(
                        'admin.students.datatables.actions',
                        compact('student')
                    )->render()
                )

                ->rawColumns([
                    'is_active',
                    'action',
                ])

                ->make(true);
        }

        return view('admin.students.index');
    }

    public function create(
        array $data
    ): RedirectResponse {

        $student = $this->studentRepository
            ->create($data);

        activity()
            ->causedBy(Auth::user())
            ->performedOn($student)
            ->event('created')
            ->withProperties([
                'student_number' => $student->student_number,
                'name' => $student->name,
            ])
            ->log('Student has been created.');

        return Redirect::route('admin.students.index')
            ->with(
                'success',
                'Student created successfully.'
            );
    }

    public function update(
        Student $student,
        array $data
    ): RedirectResponse {

        $updated = $this->studentRepository
            ->update(
                $student,
                $data
            );

        activity()
            ->causedBy(Auth::user())
            ->performedOn($updated)
            ->event('updated')
            ->withProperties([
                'student_number' => $updated->student_number,
                'name' => $updated->name,
            ])
            ->log('Student has been updated.');

        return Redirect::route('admin.students.index')
            ->with(
                'success',
                'Student updated successfully.'
            );
    }

    public function delete(
        Student $student
    ): RedirectResponse {

        activity()
            ->causedBy(Auth::user())
            ->performedOn($student)
            ->event('deleted')
            ->withProperties([
                'student_number' => $student->student_number,
                'name' => $student->name,
            ])
            ->log('Student has been deleted.');

        $this->studentRepository
            ->delete($student);

        return Redirect::route('admin.students.index')
            ->with(
                'success',
                'Student deleted successfully.'
            );
    }
}
