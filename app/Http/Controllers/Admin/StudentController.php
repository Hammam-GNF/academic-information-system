<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ImportStudentRequest;
use App\Http\Requests\Admin\StoreStudentRequest;
use App\Http\Requests\Admin\UpdateStudentRequest;
use App\Models\Student;
use App\Services\Contracts\ClassroomServiceInterface;
use App\Services\Contracts\StudentServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\JsonResponse;

class StudentController extends Controller
{
    public function __construct(
        protected StudentServiceInterface $studentService,
        protected ClassroomServiceInterface $classroomService,
    ) {}

    public function index(
        Request $request
    ): View|JsonResponse {

        $this->authorize(
            'viewAny',
            Student::class
        );

        return $this->studentService->index(
            $request
        );

    }

    public function create(): View
    {
        $this->authorize(
            'create',
            Student::class
        );

        $classrooms = $this->classroomService
            ->getActive();

        return view(
            'admin.students.create',
            compact('classrooms')
        );
    }

    public function store(
        StoreStudentRequest $request
    ): RedirectResponse {

        return $this->studentService->create(
            $request->validated()
        );

    }

    public function edit(
        Student $student
    ): View {

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
                'classrooms'
            )
        );

    }

    public function update(
        UpdateStudentRequest $request,
        Student $student
    ): RedirectResponse {

        return $this->studentService->update(
            $student,
            $request->validated()
        );

    }

    public function destroy(
        Student $student
    ): RedirectResponse {

        $this->authorize(
            'delete',
            $student
        );

        return $this->studentService->delete(
            $student
        );

    }

    public function export(): BinaryFileResponse
    {
        $this->authorize(
            'viewAny',
            Student::class
        );

        return $this->studentService->export();
    }

    public function import(
        ImportStudentRequest $request
    ): RedirectResponse {

        return $this->studentService->import(
            $request->file('file')
        );

    }

    public function downloadTemplate(): BinaryFileResponse
    {
        $this->authorize(
            'create',
            Student::class
        );

        return $this->studentService
            ->downloadTemplate();
    }
}
