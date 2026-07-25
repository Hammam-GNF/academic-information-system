<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreClassroomRequest;
use App\Http\Requests\Admin\UpdateClassroomRequest;
use App\Models\Classroom;
use App\Services\Contracts\ClassroomServiceInterface;
use App\Services\Contracts\DepartmentServiceInterface;
use App\Services\Contracts\GradeServiceInterface;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function __construct(
        protected ClassroomServiceInterface $classroomService,
        protected DepartmentServiceInterface $departmentService,
        protected GradeServiceInterface $gradeService,
    ) {}

    public function index(Request $request)
    {
        $this->authorize('viewAny', Classroom::class);

        return $this->classroomService->index($request);
    }

    public function create()
    {
        $this->authorize('create', Classroom::class);

        $departments = $this->departmentService
            ->getActive();

        $grades = $this->gradeService
            ->getActive();

        return view(
            'admin.classrooms.create',
            compact(
                'departments',
                'grades',
            )
        );
    }

    public function store(StoreClassroomRequest $request)
    {
        return $this->classroomService->create(
            $request->validated()
        );
    }

    public function edit(Classroom $classroom)
    {
        $this->authorize(
            'update',
            $classroom
        );

        $departments = $this->departmentService
            ->getActive();

        $grades = $this->gradeService
            ->getActive();

        return view(
            'admin.classrooms.edit',
            compact(
                'classroom',
                'departments',
                'grades',
            )
        );
    }

    public function update(
        UpdateClassroomRequest $request,
        Classroom $classroom
    ) {
        return $this->classroomService->update(
            $classroom,
            $request->validated()
        );
    }

    public function destroy(Classroom $classroom)
    {
        $this->authorize(
            'delete',
            $classroom
        );

        return $this->classroomService->delete(
            $classroom
        );
    }
}
