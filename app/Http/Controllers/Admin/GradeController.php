<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreGradeRequest;
use App\Http\Requests\Admin\UpdateGradeRequest;
use App\Models\Grade;
use App\Services\Contracts\GradeServiceInterface;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function __construct(
        protected GradeServiceInterface $gradeService,
    ) {}

    public function index(Request $request)
    {
        $this->authorize('viewAny', Grade::class);

        return $this->gradeService->index($request);
    }

    public function create()
    {
        $this->authorize('create', Grade::class);

        return view('admin.grades.create');
    }

    public function store(StoreGradeRequest $request)
    {
        return $this->gradeService->create(
            $request->validated()
        );
    }

    public function edit(Grade $grade)
    {
        $this->authorize('update', $grade);

        return view(
            'admin.grades.edit',
            compact('grade')
        );
    }

    public function update(
        UpdateGradeRequest $request,
        Grade $grade
    ) {
        return $this->gradeService->update(
            $grade,
            $request->validated()
        );
    }

    public function destroy(Grade $grade)
    {
        $this->authorize('delete', $grade);

        return $this->gradeService->delete(
            $grade
        );
    }
}
