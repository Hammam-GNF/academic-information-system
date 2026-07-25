<?php

namespace App\Providers;

use App\Models\AcademicYear;
use App\Models\Classroom;
use App\Models\Department;
use App\Models\Grade;
use App\Models\Semester;
use App\Models\Subject;
use App\Models\User;
use App\Policies\AcademicYearPolicy;
use App\Policies\ClassroomPolicy;
use App\Policies\DepartmentPolicy;
use App\Policies\GradePolicy;
use App\Policies\SemesterPolicy;
use App\Policies\SubjectPolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(User::class, UserPolicy::class);
        Gate::policy(AcademicYear::class, AcademicYearPolicy::class);
        Gate::policy(Semester::class, SemesterPolicy::class);
        Gate::policy(Department::class, DepartmentPolicy::class);
        Gate::policy(Grade::class, GradePolicy::class);
        Gate::policy(Classroom::class, ClassroomPolicy::class);
        Gate::policy(Subject::class, SubjectPolicy::class);
    }
}
