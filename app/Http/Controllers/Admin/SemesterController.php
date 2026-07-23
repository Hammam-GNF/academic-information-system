<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSemesterRequest;
use App\Http\Requests\Admin\UpdateSemesterRequest;
use App\Models\Semester;
use App\Services\Contracts\SemesterServiceInterface;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    public function __construct(
        protected SemesterServiceInterface $semesterService,
    ) {}

    public function index(Request $request)
    {
        return $this->semesterService->index($request);
    }

    public function create()
    {
        return view('admin.semesters.create');
    }

    public function store(StoreSemesterRequest $request)
    {
        return $this->semesterService->create(
            $request->validated()
        );
    }

    public function edit(Semester $semester)
    {
        return view(
            'admin.semesters.edit',
            compact('semester')
        );
    }

    public function update(
        UpdateSemesterRequest $request,
        Semester $semester
    ) {
        return $this->semesterService->update(
            $semester,
            $request->validated()
        );
    }

    public function destroy(Semester $semester)
    {
        return $this->semesterService->delete(
            $semester
        );
    }
}
