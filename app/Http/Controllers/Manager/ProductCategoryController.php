<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCategory\CreateRequest;
use App\Services\Product\ProductCategoryService;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    private $productCategoryService;
    public function __construct(ProductCategoryService  $productCategoryService){
        $this->productCategoryService = $productCategoryService;
    }
    public function index(){
        return view('manager.product_category.index');
    }
    public function save(CreateRequest $request){
        $params = $request->all();
        $this->productCategoryService->insert($params);
        return $this->productCategoryService->getAll();

    }
}
