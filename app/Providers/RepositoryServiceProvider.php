<?php

namespace App\Providers;

use App\Repositories\Contracts\MediaRepositoryInterface;
use App\Repositories\Contracts\SettingRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Eloquent\MediaRepository;
use App\Repositories\Eloquent\SettingRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Services\AuthService;
use App\Services\Contracts\AuthServiceInterface;
use App\Services\Contracts\MediaServiceInterface;
use App\Services\Contracts\ProfileServiceInterface;
use App\Services\Contracts\SettingServiceInterface;
use App\Services\Contracts\UserServiceInterface;
use App\Services\MediaService;
use App\Services\ProfileService;
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
    }

    public function boot(): void
    {
        //
    }
}
