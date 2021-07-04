<?php


namespace App\Repositories\Product;


use App\Models\Product;
use App\Repositories\BaseBaseRepository;

class ProductRepository extends BaseBaseRepository implements ProductInterface
{
    public function __construct(Product $modal)
    {
        parent::__construct($modal);
    }
    public function getList($params)
    {

        $data = $this->model->orderBy('id');
        if (isset($params['keyword']) && $params['keyword'] != null) {
            $data->where('name','like','%'.$params['keyword'].'%');
        }
        return $data;
    }
}