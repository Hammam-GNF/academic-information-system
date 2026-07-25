<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSubjectRequest;
use App\Http\Requests\Admin\UpdateSubjectRequest;
use App\Models\Subject;
use App\Services\Contracts\DepartmentServiceInterface;
use App\Services\Contracts\SubjectServiceInterface;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function __construct(
        protected SubjectServiceInterface $subjectService,
        protected DepartmentServiceInterface $departmentService,
    ) {}

    public function index(Request $request)
    {
        $this->authorize('viewAny', Subject::class);

        return $this->subjectService->index($request);
    }

    public function create()
    {
        $this->authorize('create', Subject::class);

        $departments = $this->departmentService
            ->getActive();

        return view(
            'admin.subjects.create',
            compact('departments')
        );
    }

    public function store(StoreSubjectRequest $request)
    {
        return $this->subjectService->create(
            $request->validated()
        );
    }

    public function edit(Subject $subject)
    {
        $this->authorize('update', $subject);

        $departments = $this->departmentService
            ->getActive();

        return view(
            'admin.subjects.edit',
            compact(
                'subject',
                'departments'
            )
        );
    }

    public function update(
        UpdateSubjectRequest $request,
        Subject $subject
    ) {
        return $this->subjectService->update(
            $subject,
            $request->validated()
        );
    }

    public function destroy(Subject $subject)
    {
        $this->authorize('delete', $subject);

        return $this->subjectService->delete(
            $subject
        );
    }
}
