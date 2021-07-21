<?php


namespace App\Repositories\Product\PriceHistories;


use App\Repositories\BaseRepositoryInterface;

interface ProductPriceHistoriesInterface extends BaseRepositoryInterface
{
    public function getList($params);
    public function getAll();
}