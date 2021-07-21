<?php


namespace App\Repositories\Product\PriceHistories;


use App\Models\ProductDetail;
use App\Repositories\BaseBaseRepository;

class ProductPriceHistoriesRepository extends BaseBaseRepository implements ProductPriceHistoriesInterface
{
    public function __construct(ProductDetail $modal)
    {
        parent::__construct($modal);
    }
    public function getList($params)
    {
        return $this->getModel()->paginate(10);
    }
    public function getAll(){
        return $this->model->select('name as label','id as code')->get()->toArray();
    }
}