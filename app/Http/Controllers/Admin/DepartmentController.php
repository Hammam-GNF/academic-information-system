<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDepartmentRequest;
use App\Http\Requests\Admin\UpdateDepartmentRequest;
use App\Models\Department;
use App\Services\Contracts\DepartmentServiceInterface;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function __construct(
        protected DepartmentServiceInterface $departmentService,
    ) {}

    public function index(Request $request)
    {
        $this->authorize('viewAny', Department::class);

        return $this->departmentService->index($request);
    }

    public function create()
    {
        $this->authorize('create', Department::class);

        return view('admin.departments.create');
    }

    public function store(StoreDepartmentRequest $request)
    {
        return $this->departmentService->create(
            $request->validated()
        );
    }

    public function edit(Department $department)
    {
        $this->authorize('update', $department);

        return view(
            'admin.departments.edit',
            compact('department')
        );
    }

    public function update(
        UpdateDepartmentRequest $request,
        Department $department
    ) {
        return $this->departmentService->update(
            $department,
            $request->validated()
        );
    }

    public function destroy(Department $department)
    {
        $this->authorize('delete', $department);

        return $this->departmentService->delete(
            $department
        );
    }
}
