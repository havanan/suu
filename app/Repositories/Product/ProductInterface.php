<?php


namespace App\Repositories\Product;


interface ProductInterface extends \App\Repositories\RepositoryContract
{
    public function getList($params);
}