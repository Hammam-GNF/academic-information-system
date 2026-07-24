<?php

namespace App\Providers;

use App\Models\AcademicYear;
use App\Models\Department;
use App\Models\Semester;
use App\Models\User;
use App\Policies\AcademicYearPolicy;
use App\Policies\DepartmentPolicy;
use App\Policies\SemesterPolicy;
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
    }
}
