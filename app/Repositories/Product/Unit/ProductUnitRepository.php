<?php


namespace App\Repositories\Product\Unit;


use App\Models\ProductUnit;
use App\Repositories\BaseBaseRepository;

class ProductUnitRepository extends BaseBaseRepository implements ProductUnitInterface
{
    public function __construct(ProductUnit $modal)
    {
        parent::__construct($modal);
    }
    public function getList($params)
    {
        return $this->getModel()->paginate(10);
    }
}