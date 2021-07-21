<?php

namespace App\Providers;

use App\Repositories\BaseBaseRepository;
use App\Repositories\Product\Amount\ProductAmountInterface;
use App\Repositories\Product\Amount\ProductAmountRepository;
use App\Repositories\Product\Category\ProductCategoryInterface;
use App\Repositories\Product\Category\ProductCategoryRepository;
use App\Repositories\Product\PriceHistories\ProductPriceHistoriesInterface;
use App\Repositories\Product\PriceHistories\ProductPriceHistoriesRepository;
use App\Repositories\Product\Media\ProductMediaInterface;
use App\Repositories\Product\Media\ProductMediaRepository;
use App\Repositories\Product\ProductInterface;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\Unit\ProductUnitInterface;
use App\Repositories\Product\Unit\ProductUnitRepository;
use App\Repositories\BaseRepositoryInterface;
use App\Repositories\Stock\Product\StockProductInterface;
use App\Repositories\Stock\Product\StockProductRepository;
use App\Repositories\User\UserInterface;
use App\Repositories\User\UserRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Stock\StockInterface;
use App\Repositories\Stock\StockRepository;

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
        $this->app->bind(ProductAmountInterface::class, ProductAmountRepository::class);
        $this->app->bind(ProductUnitInterface::class, ProductUnitRepository::class);
        $this->app->bind(ProductCategoryInterface::class, ProductCategoryRepository::class);
        $this->app->bind(ProductMediaInterface::class, ProductMediaRepository::class);
        $this->app->bind(ProductPriceHistoriesInterface::class, ProductPriceHistoriesRepository::class);
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(StockInterface::class, StockRepository::class);
        $this->app->bind(StockProductInterface::class, StockProductRepository::class);
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
