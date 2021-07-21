<?php


namespace App\Repositories\Product\Category;

use App\Helpers\Globals;
use App\Models\ProductCategory;
use App\Repositories\BaseBaseRepository;
use App\Repositories\Product\Category\ProductCategoryInterface;
use Illuminate\Support\Facades\DB;

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
        return DB::table('product_category as c1')
                ->leftJoin('product_category as c2','c1.parent_id','=','c2.id')
                ->orderBy('c1.id')
                ->orderBy('c2.parent_id')
                ->select('c1.id', 'c1.id as code',)
                ->selectRaw("
                        CASE
                            WHEN c1.parent_id = '' Then c1.name
                            WHEN c1.parent_id IS NULL Then c1.name
                        ELSE CONCAT(' -- ',c1.name) 
                        END
                        as label")
            ->where('c1.status',Globals::ACTIVE)
            ->get();
    }
}