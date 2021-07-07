<?php


namespace App\Repositories\Product\Media;


use App\Repositories\BaseRepositoryInterface;

interface ProductMediaInterface extends BaseRepositoryInterface
{
    public function getList($params);
    public function getAll();
}