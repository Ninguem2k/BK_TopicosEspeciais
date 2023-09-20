<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\CategoryRepository;
use App\Repositories\ServiceRepository;
use App\Repositories\ServiceImageRepository;
use App\Repositories\UserRepository;
use App\Repositories\UserTokenRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CategoryRepository::class, function ($app) {
            return new CategoryRepository();
        });

        $this->app->singleton(ServiceRepository::class, function ($app) {
            return new ServiceRepository();
        });

        $this->app->singleton(ServiceImageRepository::class, function ($app) {
            return new ServiceImageRepository();
        });

        $this->app->singleton(UserRepository::class, function ($app) {
            return new UserRepository();
        });

        $this->app->singleton(UserTokenRepository::class, function ($app) {
            return new UserTokenRepository();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
