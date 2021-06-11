<?php


namespace App\Services\Product;


use App\Repositories\Product\Unit\ProductUnitInterface;
use App\Services\BaseService;

class UnitService extends BaseService
{
    public function __construct(ProductUnitInterface $repository)
    {
        parent::__construct($repository);
    }
    public function getList($params){
        return $this->repository->getList($params);
    }
}