<?php

namespace App\Providers;

use App\Repositories\BaseRepositoryInterface;
use App\Repositories\PermissionRepositoryInterface;
use App\Repositories\PermissionCustomerRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\ProductDetailRepositoryInterface;

use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Eloquent\PermissionRepository;
use App\Repositories\Eloquent\PermissionCustomerRepository;
use App\Repositories\Eloquent\ProductRepository;
use App\Repositories\Eloquent\ProductDetailRepository;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(PermissionRepositoryInterface::class, PermissionRepository::class);
        $this->app->bind(PermissionCustomerRepositoryInterface::class, PermissionCustomerRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(ProductDetailRepositoryInterface::class, ProductDetailRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
