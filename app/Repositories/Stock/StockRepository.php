<?php


namespace App\Repositories\Stock;


use App\Models\Stock;
use App\Repositories\BaseBaseRepository;

class StockRepository extends BaseBaseRepository implements StockInterface
{
    public function __construct(Stock $modal)
    {
        parent::__construct($modal);
    }
    public function getList($params)
    {
        $data = $this->model->with(['owner'])->orderBy('id','DESC');
        if (isset($params['keyword']) && $params['keyword'] != null) {
            $data->where('name','like','%'.$params['keyword'].'%')
                ->orWhere('address','like','%'.$params['keyword'].'%')
                ->orWhere('phone','like','%'.$params['keyword'].'%');
        }
        return $data;
    }
    public function getParents(){
        return $this->model->whereNull('parent_id')->select('name as label','id as code')->get()->toArray();
    }
}