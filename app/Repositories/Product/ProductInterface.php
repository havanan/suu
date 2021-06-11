<?php


namespace App\Repositories\Product;


interface ProductInterface extends \App\Repositories\BaseRepositoryInterface
{
    public function getList($params);
}