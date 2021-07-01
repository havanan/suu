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
        return $data;
    }

    public function insert($params)
    {
        // TODO: Implement insert() method.
    }
}