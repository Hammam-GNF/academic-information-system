<?php

namespace App\Providers;

use App\Repositories\Contracts\AcademicYearRepositoryInterface;
use App\Repositories\Contracts\ClassroomRepositoryInterface;
use App\Repositories\Contracts\DepartmentRepositoryInterface;
use App\Repositories\Contracts\GradeRepositoryInterface;
use App\Repositories\Contracts\MediaRepositoryInterface;
use App\Repositories\Contracts\SemesterRepositoryInterface;
use App\Repositories\Contracts\SettingRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Eloquent\AcademicYearRepository;
use App\Repositories\Eloquent\ClassroomRepository;
use App\Repositories\Eloquent\DepartmentRepository;
use App\Repositories\Eloquent\GradeRepository;
use App\Repositories\Eloquent\MediaRepository;
use App\Repositories\Eloquent\SemesterRepository;
use App\Repositories\Eloquent\SettingRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Services\AcademicYearService;
use App\Services\AuthService;
use App\Services\ClassroomService;
use App\Services\Contracts\AcademicYearServiceInterface;
use App\Services\Contracts\AuthServiceInterface;
use App\Services\Contracts\ClassroomServiceInterface;
use App\Services\Contracts\DepartmentServiceInterface;
use App\Services\Contracts\GradeServiceInterface;
use App\Services\Contracts\MediaServiceInterface;
use App\Services\Contracts\ProfileServiceInterface;
use App\Services\Contracts\SemesterServiceInterface;
use App\Services\Contracts\SettingServiceInterface;
use App\Services\Contracts\UserServiceInterface;
use App\Services\DepartmentService;
use App\Services\GradeService;
use App\Services\MediaService;
use App\Services\ProfileService;
use App\Services\SemesterService;
use App\Services\SettingService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->bind(
            UserServiceInterface::class,
            UserService::class
        );

        $this->app->bind(
            AuthServiceInterface::class,
            AuthService::class
        );

        $this->app->bind(
            ProfileServiceInterface::class,
            ProfileService::class
        );

        $this->app->bind(
            SettingRepositoryInterface::class,
            SettingRepository::class
        );

        $this->app->bind(
            SettingServiceInterface::class,
            SettingService::class
        );

        $this->app->bind(
            MediaRepositoryInterface::class,
            MediaRepository::class
        );

        $this->app->bind(
            MediaServiceInterface::class,
            MediaService::class
        );

        $this->app->bind(
            AcademicYearRepositoryInterface::class,
            AcademicYearRepository::class
        );

        $this->app->bind(
            AcademicYearServiceInterface::class,
            AcademicYearService::class
        );

        $this->app->bind(
            SemesterRepositoryInterface::class,
            SemesterRepository::class
        );

        $this->app->bind(
            SemesterServiceInterface::class,
            SemesterService::class
        );

        $this->app->bind(
            DepartmentRepositoryInterface::class,
            DepartmentRepository::class
        );

        $this->app->bind(
            DepartmentServiceInterface::class,
            DepartmentService::class
        );

        $this->app->bind(
            GradeRepositoryInterface::class,
            GradeRepository::class
        );

        $this->app->bind(
            GradeServiceInterface::class,
            GradeService::class
        );

        $this->app->bind(
            ClassroomRepositoryInterface::class,
            ClassroomRepository::class
        );

        $this->app->bind(
            ClassroomServiceInterface::class,
            ClassroomService::class
        );
    }

    public function boot(): void
    {
        //
    }
}
