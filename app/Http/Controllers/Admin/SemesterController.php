<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSemesterRequest;
use App\Http\Requests\Admin\UpdateSemesterRequest;
use App\Models\Semester;
use App\Services\Contracts\AcademicYearServiceInterface;
use App\Services\Contracts\SemesterServiceInterface;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    public function __construct(
        protected SemesterServiceInterface $semesterService,
        protected AcademicYearServiceInterface $academicYearService,
    ) {}

    public function index(Request $request)
    {
        $this->authorize('viewAny', Semester::class);

        return $this->semesterService->index($request);
    }

    public function create()
    {
        $this->authorize('create', Semester::class);

        $academicYears = $this->academicYearService->query()
            ->get();

        return view(
            'admin.semesters.create',
            compact('academicYears')
        );
    }

    public function store(StoreSemesterRequest $request)
    {
        return $this->semesterService->create(
            $request->validated()
        );
    }

    public function edit(Semester $semester)
    {
        $this->authorize('update', $semester);

        $academicYears = $this->academicYearService->query()
            ->get();

        return view(
            'admin.semesters.edit',
            compact(
                'semester',
                'academicYears'
            )
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
        $this->authorize('delete', $semester);

        return $this->semesterService->delete(
            $semester
        );
    }
}
