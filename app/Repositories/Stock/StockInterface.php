<?php


namespace App\Repositories\Stock;


use App\Repositories\BaseRepositoryInterface;

interface StockInterface extends BaseRepositoryInterface
{
    public function getList($params);
    public function getParents();
}