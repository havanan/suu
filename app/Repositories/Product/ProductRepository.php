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
        $data = $this->query->get();
        return $data;
    }
}