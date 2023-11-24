<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;




class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Interfaces\Api\V1\UserRepositoryInterface::class,
            \App\Repositories\Api\V1\UserRepository::class 
        );
        $this->app->bind(
            \App\Interfaces\Api\V1\CompanyRepositoryInterface::class,
            \App\Repositories\Api\V1\CompanyRepository::class ,
        );
        $this->app->bind(
            \App\Interfaces\Api\V1\CommentRepositoryInterface::class,
            \App\Repositories\Api\V1\CommentRepository::class ,
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
