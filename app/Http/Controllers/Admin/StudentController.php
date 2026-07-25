<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreStudentRequest;
use App\Http\Requests\Admin\UpdateStudentRequest;
use App\Models\Student;
use App\Services\Contracts\ClassroomServiceInterface;
use App\Services\Contracts\StudentServiceInterface;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function __construct(
        protected StudentServiceInterface $studentService,
        protected ClassroomServiceInterface $classroomService,
    ) {}

    public function index(Request $request)
    {
        $this->authorize('viewAny', Student::class);

        return $this->studentService->index($request);
    }

    public function create()
    {
        $this->authorize('create', Student::class);

        $classrooms = $this->classroomService
            ->getActive();

        return view(
            'admin.students.create',
            compact('classrooms')
        );
    }

    public function store(StoreStudentRequest $request)
    {
        return $this->studentService->create(
            $request->validated()
        );
    }

    public function edit(Student $student)
    {
        $this->authorize(
            'update',
            $student
        );

        $classrooms = $this->classroomService
            ->getActive();

        return view(
            'admin.students.edit',
            compact(
                'student',
                'classrooms',
            )
        );
    }

    public function update(
        UpdateStudentRequest $request,
        Student $student
    ) {
        return $this->studentService->update(
            $student,
            $request->validated()
        );
    }

    public function destroy(Student $student)
    {
        $this->authorize(
            'delete',
            $student
        );

        return $this->studentService->delete(
            $student
        );
    }
}
