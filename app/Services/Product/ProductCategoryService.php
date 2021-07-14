<?php


namespace App\Services\Product;

use App\Repositories\Product\Category\ProductCategoryInterface;
use App\Services\BaseService;
class ProductCategoryService extends BaseService
{
    public function __construct(ProductCategoryInterface $repository)
    {
        parent::__construct($repository);
    }
    public function getList($params){
        $data = $this->repository->getList($params);
        $data = paging($data,$params['page']);
        return $data;
    }
    public function getAll(){
        return $this->repository->getAll();
    }
}