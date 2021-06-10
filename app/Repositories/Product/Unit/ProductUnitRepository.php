<?php


namespace App\Repositories\Product\Unit;


use App\Models\ProductUnit;
use App\Repositories\BaseRepository;

class ProductUnitRepository extends BaseRepository
{
    protected $_model;
    public function __construct(ProductUnit $modal)
    {
        $this->_model = $modal;
    }
    public function getList($params)
    {
        $data = $this->_model->query()->paginate(10);
        return $data;
    }
}