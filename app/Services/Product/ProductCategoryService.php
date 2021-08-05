<?php


namespace App\Services\Product;

use App\Helpers\Globals;
use App\Repositories\Product\Category\ProductCategoryInterface;
use App\Services\BaseService;
class ProductCategoryService extends BaseService
{
    public function __construct(ProductCategoryInterface $repository)
    {
        parent::__construct($repository);
    }
    public function getList($params){
        $page = isset($params['page']) ? $params['page'] : Globals::CURRENT_PAGE;
        $data = $this->repository->getList($params);
        $data = paging($data,$page);
        return $data;
    }
    public function getAll(){
        return $this->repository->getAll();
    }
    public function getParents(){
        return $this->repository->getParents();
    }
}