<?php


namespace App\Services\Product;


use App\Repositories\Product\Unit\ProductUnitRepository;
use App\Services\BaseService;

class UnitService extends BaseService
{
    private $_repo;

    public function __construct(ProductUnitRepository $repository)
    {
        $this->_repo = $repository;
    }
    public function getList($params){
        return $this->_repo->getList($params);
    }
}