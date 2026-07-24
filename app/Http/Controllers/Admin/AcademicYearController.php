<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAcademicYearRequest;
use App\Http\Requests\Admin\UpdateAcademicYearRequest;
use App\Models\AcademicYear;
use App\Services\Contracts\AcademicYearServiceInterface;
use Illuminate\Http\Request;

class AcademicYearController extends Controller
{
    public function __construct(
        protected AcademicYearServiceInterface $academicYearService,
    ) {}

    public function index(Request $request)
    {
        $this->authorize('viewAny', AcademicYear::class);

        return $this->academicYearService->index($request);
    }

    public function create()
    {
        $this->authorize('create', AcademicYear::class);
        
        return view('admin.academic-years.create');
    }

    public function store(StoreAcademicYearRequest $request)
    {
        return $this->academicYearService->create(
            $request->validated()
        );
    }

    public function edit(AcademicYear $academicYear)
    {
        $this->authorize('update', $academicYear);

        return view(
            'admin.academic-years.edit',
            compact('academicYear')
        );
    }

    public function update(
        UpdateAcademicYearRequest $request,
        AcademicYear $academicYear
    ) {
        return $this->academicYearService->update(
            $academicYear,
            $request->validated()
        );
    }

    public function destroy(AcademicYear $academicYear)
    {
        $this->authorize('delete', $academicYear);

        return $this->academicYearService->delete(
            $academicYear
        );
    }
}
