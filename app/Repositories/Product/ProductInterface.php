<?php


namespace App\Repositories\Product;


use App\Repositories\BaseRepositoryInterface;

interface ProductInterface extends BaseRepositoryInterface
{
    public function getList($params);
    public function getChildIds($parent_id);
}