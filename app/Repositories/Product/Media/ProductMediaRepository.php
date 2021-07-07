<?php


namespace App\Repositories\Product\Media;

use App\Models\ProductMedia;
use App\Repositories\BaseBaseRepository;
use App\Repositories\Product\Media\ProductMediaInterface;
class ProductMediaRepository extends BaseBaseRepository implements ProductMediaInterface
{
    public function __construct(ProductMedia $modal)
    {
        parent::__construct($modal);
    }
    public function getList($params)
    {
        return $this->getModel()->paginate(10);
    }
    public function getAll(){
        return $this->model->get();
    }
}