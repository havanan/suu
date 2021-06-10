<?php


namespace App\Repositories\Product\Unit;


use App\Repositories\RepositoryContract;

interface ProductUnitInterface extends RepositoryContract
{
    public function getList($params);
}