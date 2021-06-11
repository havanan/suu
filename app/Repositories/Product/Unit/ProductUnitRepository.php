<?php


namespace App\Repositories\Product\Unit;


use App\Models\ProductUnit;
use App\Repositories\BaseBaseRepository;
use App\Repositories\Product\ProductInterface;

class ProductUnitRepository extends BaseBaseRepository implements ProductInterface
{
    public function __construct(ProductUnit $modal)
    {
        parent::__construct($modal);

    }
    public function getList($params)
    {
        $data = $this->getModel()->paginate(10);
        return $data;
    }
}