<?php

namespace App\Providers;

use App\Services\Categories\Repositories\CategoryRepository;
use App\Services\Categories\Repositories\EloquentCategoryRepository;
use App\Services\Companies\Repositories\CompanyRepository;
use App\Services\Companies\Repositories\EloquentCompanyRepository;
use App\Services\Dishes\Repositories\DishRepository;
use App\Services\Dishes\Repositories\EloquentDishRepository;
use App\Services\Orders\Repositories\EloquentOrderRepository;
use App\Services\Orders\Repositories\OrderRepository;
use App\Services\Packages\Repositories\EloquentPackageRepository;
use App\Services\Packages\Repositories\PackageRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CompanyRepository::class, EloquentCompanyRepository::class);
        $this->app->bind(CategoryRepository::class, EloquentCategoryRepository::class);
        $this->app->bind(DishRepository::class, EloquentDishRepository::class);
        $this->app->bind(OrderRepository::class, EloquentOrderRepository::class);
        $this->app->bind(PackageRepository::class, EloquentPackageRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
