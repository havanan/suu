<?php


namespace App\Repositories\Product\Unit;


use App\Repositories\BaseRepositoryInterface;

interface ProductUnitInterface extends BaseRepositoryInterface
{
    public function getList($params);
    public function getAll();
}