<?php


namespace App\Repositories\Stock\Product;


use App\Repositories\BaseRepositoryInterface;

interface StockProductInterface extends BaseRepositoryInterface
{
    public function getList($params);
    public function getParents();
}