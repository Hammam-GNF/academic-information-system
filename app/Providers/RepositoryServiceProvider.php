<?php

namespace App\Providers;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Eloquent\UserRepository;
use App\Services\Contracts\UserServiceInterface;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Repository Bindings
        |--------------------------------------------------------------------------
        */

        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        /*
        |--------------------------------------------------------------------------
        | Service Bindings
        |--------------------------------------------------------------------------
        */

        $this->app->bind(
            UserServiceInterface::class,
            UserService::class
        );
    }

    public function boot(): void
    {
        //
    }
}
