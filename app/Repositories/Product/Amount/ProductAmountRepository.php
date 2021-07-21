<?php


namespace App\Repositories\Product\Amount;


use App\Models\ProductAmount;
use App\Repositories\BaseBaseRepository;

class ProductAmountRepository extends BaseBaseRepository implements ProductAmountInterface
{
    public function __construct(ProductAmount $modal)
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