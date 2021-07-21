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
            //nhập sp
            $product_id = $this->createProduct($params);
            //nhập sản phẩm con
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
    function createProduct($params){
        $price = isset($params['price']) ? $params['price'] : null;
        $price_discount = isset($params['price_discount']) ? $params['price_discount'] : null;
        $price_import = isset($params['price_import']) ? $params['price_import'] : null;
        $productParams = [
                'name' =>  isset($params['name']) ? $params['name'] : null,
                'slug' =>  isset($params['slug']) ? $params['slug'] : null,
                'description' =>  isset($params['description']) ? $params['description'] : null,
                'category_id' =>  isset($params['category_id']) ? $params['category_id'] : null,
                'price' => $price,
                'price_discount' => $price_discount,
                'price_import' => $price_import,
                'image' => !empty($params['images']) ? json_encode($params['images']) : null,
                'type' => isset($params['type']) ? $params['type'] : Globals::PRODUCT,
                'status' => isset($params['status']) ? $params['status'] : Globals::ACTIVE,
                'parent_id' => isset($params['parent_id']) ? $params['parent_id'] : null,
                'color' => isset($params['color']) ? $params['color'] : null,
                'size' => isset($params['size']) ? $params['size'] : null,
        ];
        //lưu sản phẩm
        $product = $this->repository->create($productParams);
        $product_id = $product->id;
        //lưu lịch sử giá sản phẩm
        $this->priceHistory->create([
                'price' => $price,
                'price_discount' => $price_discount,
                'price_import' => $price_import,
                'product_id' => $product_id
        ]);
        //nhập kho
        $this->importStock([
                'product_id' => $product_id,
                'stock_id' => isset($params['stock_id']) ? $params['stock_id'] : Globals::STOCK_DEFAULT,
                'total' => isset($params['total']) ? $params['total'] : 0,
        ]);
        return $product->id;
    }
    function importStock($params){
        //nhập sp vào kho
        $stock_product = $this->stockProduct->create($params);
        //lưu lịch sử nhập sản phẩm
        $this->productAmount->create([
                'stock_product_id' => $stock_product->id,
                'total' => $params['total']
        ]);
        return $stock_product;
    }
}