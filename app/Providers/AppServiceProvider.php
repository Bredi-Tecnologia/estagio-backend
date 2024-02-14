<?php

namespace App\Providers;

use App\Repository\ProductRepository;
use App\Service\ProdutoService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Repository
        $this->app->singleton(ProductRepository::class, function ($app) {
            return new ProductRepository();
        });

        // Services
        $this->app->singleton(ProdutoService::class, function ($app) {
            return new ProdutoService($app->make(ProductRepository::class));
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
