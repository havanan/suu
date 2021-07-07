<?php


namespace App\Services\Product;


use App\Helpers\Globals;
use App\Repositories\Product\ProductInterface;
use App\Repositories\Product\Unit\ProductUnitInterface;
use App\Services\BaseService;
class ProductCategotyService extends BaseService
{
    public function __construct(ProductInterface $repository)
    {
        parent::__construct($repository);
    }
    public function getList($params){
        $data = $this->repository->getList($params);
        $data = paging($data,$params['page']);
        return $data;
    }
}