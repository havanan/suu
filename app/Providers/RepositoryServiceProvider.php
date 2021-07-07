<?php

namespace App\Providers;

use App\Repositories\BaseBaseRepository;
use App\Repositories\Product\Category\ProductCategoryInterface;
use App\Repositories\Product\Category\ProductCategoryRepository;
use App\Repositories\Product\Media\ProductMediaInterface;
use App\Repositories\Product\Media\ProductMediaRepository;
use App\Repositories\Product\ProductInterface;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\Unit\ProductUnitInterface;
use App\Repositories\Product\Unit\ProductUnitRepository;
use App\Repositories\BaseRepositoryInterface;
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
        $this->app->bind(BaseRepositoryInterface::class, BaseBaseRepository::class);
        $this->app->bind(ProductInterface::class, ProductRepository::class);
        $this->app->bind(ProductUnitInterface::class, ProductUnitRepository::class);
        $this->app->bind(ProductCategoryInterface::class, ProductCategoryRepository::class);
        $this->app->bind(ProductMediaInterface::class, ProductMediaRepository::class);


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
