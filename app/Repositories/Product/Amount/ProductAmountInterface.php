<?php


namespace App\Repositories\Product\Amount;


use App\Repositories\BaseRepositoryInterface;

interface ProductAmountInterface extends BaseRepositoryInterface
{
    public function getList($params);
    public function getAll();
}