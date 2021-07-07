<?php


namespace App\Repositories\Product\Category;


use App\Repositories\BaseRepositoryInterface;

interface ProductCategoryInterface extends BaseRepositoryInterface
{
    public function getList($params);
    public function getAll();
}