<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSubjectRequest;
use App\Http\Requests\Admin\UpdateSubjectRequest;
use App\Models\Department;
use App\Models\Subject;
use App\Services\Contracts\SubjectServiceInterface;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function __construct(
        protected SubjectServiceInterface $subjectService,
    ) {}

    public function index(Request $request)
    {
        $this->authorize('viewAny', Subject::class);

        return $this->subjectService->index($request);
    }

    public function create()
    {
        $this->authorize('create', Subject::class);

        return view(
            'admin.subjects.create',
            [
                'departments' => Department::query()
                    ->orderBy('name')
                    ->get(),
            ]
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

        return view(
            'admin.subjects.edit',
            [
                'subject' => $subject,

                'departments' => Department::query()
                    ->orderBy('name')
                    ->get(),
            ]
        );
    }

    public function update(
        UpdateSubjectRequest $request,
        Subject $subject,
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
