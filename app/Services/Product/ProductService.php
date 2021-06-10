<?php


namespace App\Services\Product;


use App\Helpers\Globals;
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

    public function getProperty(){
        $data = [
            'sizes' => Globals::SIZES,
            'colors' => Globals::COLORS
        ];
        return $data;
    }
}