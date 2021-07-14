<?php


namespace App\Repositories\Product\Category;

use App\Helpers\Globals;
use App\Models\ProductCategory;
use App\Repositories\BaseBaseRepository;
use App\Repositories\Product\Category\ProductCategoryInterface;
class ProductCategoryRepository extends BaseBaseRepository implements ProductCategoryInterface
{
    public function __construct(ProductCategory $modal)
    {
        parent::__construct($modal);
    }
    public function getList($params)
    {
        return $this->getModel()->paginate(10);
    }
    public function getAll(){
        return $this->model->with(['children'])
                ->select('name as label','parent_id','id','id as code')
            ->where('status',Globals::ACTIVE)
            ->where(function ($q) {
                $q->where('parent_id',null)->orWhere('parent_id','');
            })
            ->orderBy('id')
            ->get();
    }
}