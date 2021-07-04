<?php


namespace App\Services\Product;


use App\Helpers\Globals;
use App\Repositories\Product\ProductInterface;
use App\Repositories\Product\Unit\ProductUnitInterface;
use App\Services\BaseService;
class ProductService extends BaseService
{
    private $productUnit;
    public function __construct(ProductInterface $repository, ProductUnitInterface $productUnit)
    {
        parent::__construct($repository);
        $this->productUnit = $productUnit;
    }
    public function getList($params){
        $data = $this->repository->getList($params);
        $data = paging($data,$params['page']);
        return $data;
    }

    public function getProperty(){
        $units = $this->productUnit->getAll();
        return [
            'sizes' => Globals::SIZES,
            'colors' => Globals::COLORS,
            'status' => Globals::PRODUCT_STATUS,
            'units' => $units
        ];
    }
}