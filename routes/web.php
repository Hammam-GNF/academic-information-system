<?php

use App\Http\Controllers\Admin\AcademicYearController;
use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\ClassroomController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\GradeController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\SemesterController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    if (! Auth::check()) {
        return view('welcome');
    }

    /** @var User $user */
    $user = Auth::user();

    return $user->hasRole('admin')
        ? redirect()->route('admin.dashboard')
        : redirect()->route('user.dashboard');

});

Route::prefix('user')
    ->name('user.')
    ->middleware(['auth', 'verified', 'role:user'])
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('user.dashboard');
        })->name('dashboard');

    });

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])
        ->name('profile.avatar');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('users', UserController::class);

        Route::resource('academic-years', AcademicYearController::class);

        Route::resource('semesters', SemesterController::class);

        Route::resource('departments', DepartmentController::class);

        Route::resource('grades', GradeController::class);

        Route::resource('classrooms', ClassroomController::class);

        Route::resource('subjects', SubjectController::class);

        Route::get('users/{user}/change-password', [UserController::class, 'changePassword'])
            ->name('users.change-password');

        Route::put('users/{user}/update-password', [UserController::class, 'updatePassword'])
            ->name('users.update-password');

        Route::get('/activity-logs', [ActivityLogController::class, 'index'])
            ->name('activity-logs.index');

        Route::get('/settings', [SettingController::class, 'index'])
            ->name('settings.index');

        Route::put('/settings', [SettingController::class, 'update'])
            ->name('settings.update');

        Route::get('/media', [MediaController::class, 'index'])
            ->name('media.index');

        Route::post('/media', [MediaController::class, 'store'])
            ->name('media.store');

        Route::delete('/media/{media}', [MediaController::class, 'destroy'])
            ->name('media.destroy');

        Route::get('users-export', [UserController::class, 'export'])
            ->name('users.export');

        Route::get('users-trash', [UserController::class, 'trash'])
            ->name('users.trash');

        Route::put('users/{user}/restore', [UserController::class, 'restore'])
            ->name('users.restore');

        Route::delete('users/{user}/force-delete', [UserController::class, 'forceDelete'])
            ->name('users.force-delete');

    });

require __DIR__.'/auth.php';
