<?php

namespace App\Providers;

use App\Application\Interfaces\AnalyticsRepositoryInterface;
use App\Application\Interfaces\OrderRepositoryInterface;
use App\Application\Interfaces\ProductRepositoryInterface;
use App\Infrastructure\Eloquent\EloquentAnalyticsRepository;
use App\Infrastructure\Eloquent\EloquentOrderRepository;
use App\Infrastructure\Eloquent\EloquentProductRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(OrderRepositoryInterface::class, EloquentOrderRepository::class);
        $this->app->bind(AnalyticsRepositoryInterface::class, EloquentAnalyticsRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, EloquentProductRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
