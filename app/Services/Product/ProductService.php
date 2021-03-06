<?php


namespace App\Services\Product;


use App\Helpers\Globals;
use App\Repositories\Product\Amount\ProductAmountInterface;
use App\Repositories\Product\Category\ProductCategoryInterface;
use App\Repositories\Product\PriceHistories\ProductPriceHistoriesInterface;
use App\Repositories\Product\Media\ProductMediaInterface;
use App\Repositories\Product\ProductInterface;
use App\Repositories\Product\Unit\ProductUnitInterface;
use App\Repositories\Stock\Product\StockProductInterface;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductService extends BaseService
{
    private $productUnit;
    private $productCategory;
    private $productMedia;
    private $priceHistory;
    private $stockProduct;
    private $productAmount;
    public function __construct(
            ProductInterface $repository,
            ProductAmountInterface $productAmount,
            ProductUnitInterface $productUnit,
            ProductCategoryInterface $productCategory,
            ProductMediaInterface $productMedia,
            ProductPriceHistoriesInterface $priceHistory,
            StockProductInterface $stockProduct
        )
    {
        parent::__construct($repository);
        $this->productUnit = $productUnit;
        $this->productAmount = $productAmount;
        $this->productCategory = $productCategory;
        $this->productMedia = $productMedia;
        $this->priceHistory = $priceHistory;
        $this->stockProduct = $stockProduct;
    }
    public function getList($params){
        $page = isset($params['page']) ? $params['page'] : Globals::CURRENT_PAGE;
        $data = $this->repository->getList($params);
        $data = paging($data,$page);
        return $data;
    }

    public function getProperty(){
        $units = $this->productUnit->getAll();
        $categories = $this->productCategory->getAll();
        return [
            'categories' => $categories,
            'sizes' => Globals::SIZES,
            'colors' => Globals::COLORS,
            'status' => Globals::PRODUCT_STATUS,
            'units' => $units,
        ];
    }
    public function createMedia($params){
        return $this->productMedia->create($params);
    }
    public function create($params){
        DB::beginTransaction();
        try {
            //nh???p sp
            $product_id = $this->createProduct($params);
            //nh???p s???n ph???m con
            $productDetail = $params['details'];
            if (!empty($productDetail)){
                $params['parent_id'] = $product_id;
                foreach ($productDetail as $key => $detail){
                    $params = $detail + $params;
                    $params['image'] = [$detail['image']];
                    $this->createProduct($params);
                }
            }
            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
        }
    }
    public function update($id, array $data)
    {
        $info = $this->repository->findById($id);

        if (!$info){
            return  resFail('Kh??ng c?? th??ng tin s???n ph???m');
        }
        DB::beginTransaction();
        try {
            $this->repository->update($id,$data);
            $price = $data['price'];
            $price_discount = $data['price_discount'];
            $price_import = $data['price_import'];

            if ($info->price != $price || $info->price_discount != $price_discount || $info->price_import != $price_import){
              $abc = $this->priceHistory->create([
                        'price' => (int) $price,
                        'price_discount' =>(int) $price_discount,
                        'price_import' =>(int) $price_import,
                        'product_id' => $id
                ]);
            }
            DB::commit();
            return  resSuccess('C???p nh???t th??nh c??ng');
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return  resFail('C???p nh???t th???t b???i');
        }
    }

    function createProduct($params){
        $price = isset($params['price']) ? $params['price'] : null;
        $price_discount = isset($params['price_discount']) ? $params['price_discount'] : null;
        $price_import = isset($params['price_import']) ? $params['price_import'] : null;
        $size = isset($params['size']) ? $params['size'] : null;
        $color = isset($params['color']) ? $params['color'] : null;
        $name =  isset($params['name']) ? $params['name'] : null;
        $name .= ' '.$size.' '.$color;
        $slug = isset($params['slug']) && $params['slug']  != null ? $params['slug'] : Str::slug($name,'-');
        $productParams = [
                'name' =>  $name,
                'slug' =>  $slug,
                'description' =>  isset($params['description']) ? $params['description'] : null,
                'category_id' =>  isset($params['category_id']) ? $params['category_id'] : null,
                'price' => $price,
                'price_discount' => $price_discount,
                'price_import' => $price_import,
                'image' => !empty($params['images']) ? json_encode($params['images']) : null,
                'type' => isset($params['type']) ? $params['type'] : Globals::PRODUCT,
                'status' => isset($params['status']) ? $params['status'] : Globals::ACTIVE,
                'parent_id' => isset($params['parent_id']) ? $params['parent_id'] : null,
                'color' => $color,
                'size' => $size,
                'unit' => isset($params['unit']) ? $params['unit'] : null,
        ];
        //l??u s???n ph???m
        $product = $this->repository->create($productParams);
        $product_id = $product->id;
        //l??u l???ch s??? gi?? s???n ph???m
        $this->priceHistory->create([
                'price' => $price,
                'price_discount' => $price_discount,
                'price_import' => $price_import,
                'product_id' => $product_id
        ]);
        //nh???p kho
        $this->importStock([
                'product_id' => $product_id,
                'stock_id' => isset($params['stock_id']) ? $params['stock_id'] : Globals::STOCK_DEFAULT,
                'total' => isset($params['total']) ? $params['total'] : 0,
        ]);
        return $product->id;
    }
    function importStock($params){
        //nh???p sp v??o kho
        $stock_product = $this->stockProduct->create($params);
        //l??u l???ch s??? nh???p s???n ph???m
        $this->productAmount->create([
                'stock_product_id' => $stock_product->id,
                'total' => $params['total']
        ]);
        return $stock_product;
    }
    public function getInfo($id,$isChild = false){
        $info = $this->repository->findById($id);
        $childs = null;
        if ($isChild){
            $info['details'] = $this->repository->getList(['parent_id' => $id])->get();
        }
        return $info;
    }
    public function getChildIds($parent_id){
        $result = [(int)$parent_id];
        $ids = $this->repository->getChildIds($parent_id);
        if (count($ids) > 0) {
            $result = array_unique(array_merge($result,$ids));
        }
      return $result;
    }
    public function delete(array $ids)
    {
        DB::beginTransaction();
        try {
            //x??a s???n ph???m
            $this->repository->delete($ids);
            //x??a kho
            $this->stockProduct->deleteWhereIn('product_id',$ids);
            //x??a s??? l?????ng
            $this->productAmount->deleteWhereIn('product_id',$ids);
            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
        }
    }
}