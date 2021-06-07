<?php


namespace App\Services\Product;


use App\Repositories\Product\ProductInterface;
use App\Services\BaseService;

class ProductService extends BaseService
{
    public function __construct(ProductInterface $repository)
    {
        parent::__construct($repository);
    }
    public function getList($params){
        $data = $this->repository->getList($params);
        return \paginate($data);
    }
}