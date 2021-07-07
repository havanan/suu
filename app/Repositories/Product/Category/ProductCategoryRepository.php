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
        return $this->model->with('child')->select('product_category.name as label','product_category.id as code')
            ->where('product_category.status',Globals::ACTIVE)
            ->whereNull('product_category.parent_id')
            ->orderBy('product_category.id')
            ->get();
    }
}