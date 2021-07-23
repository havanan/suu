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
        $data = $this->model
                ->leftJoin('product_category','product_category.id','products.category_id')
                ->orderBy('products.id');
        if (isset($params['parent_id'])){
            $data = $data->where('products.parent_id',$params['parent_id']);
        }else {
            $data = $data->whereNull('products.parent_id');
        }
        if (isset($params['keyword']) && $params['keyword'] != null) {
            $data->where('products.name','like','%'.$params['keyword'].'%');
        }
        $data = $data->select('products.*','product_category.name as category_name')->withSum( 'stocks','total');

        return $data;
    }
    public function getChildIds($parent_id){
        return $this->model->where('parent_id',$parent_id)->pluck('id')->toArray();
    }
}