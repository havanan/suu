<?php


namespace App\Services\Product;


use App\Helpers\Globals;
use App\Repositories\Product\Category\ProductCategoryInterface;
use App\Repositories\Product\Media\ProductMediaInterface;
use App\Repositories\Product\ProductInterface;
use App\Repositories\Product\Unit\ProductUnitInterface;
use App\Services\BaseService;
class ProductService extends BaseService
{
    private $productUnit;
    private $productCategory;
    private $productMedia;
    public function __construct(
                                ProductInterface $repository,
                                ProductUnitInterface $productUnit,
                                ProductCategoryInterface $productCategory,
                                ProductMediaInterface $productMedia
        )
    {
        parent::__construct($repository);
        $this->productUnit = $productUnit;
        $this->productCategory = $productCategory;
        $this->productMedia = $productMedia;
    }
    public function getList($params){
        $data = $this->repository->getList($params);
        $data = paging($data,$params['page']);
        return $data;
    }

    public function getProperty(){
        $units = $this->productUnit->getAll();
        $categories = $this->productCategory->getAll();
        return [
            'categories' => $categories,
            'sizes' => Globals::SIZES,
            'colors' => Globals::COLORS,
            'status' => Globals::PRODUCT_STATUS,
            'units' => $units,

        ];
    }
    public function createMedia($params){
        return $this->productMedia->create($params);
    }
    public function create($params){
        //nhập sp

        //nhập kho

        //nhập giá sp

        //nhập sản phẩm con
    }
}