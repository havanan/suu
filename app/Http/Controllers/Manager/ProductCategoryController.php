<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCategory\CreateRequest;
use App\Http\Requests\ProductCategory\UpdateRequest;
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
    public function getList(Request $request){
        $params = $request->all();
        return $this->productCategoryService->getList($params);
    }
    public function getParents(){
        return $this->productCategoryService->getParents();
    }
    public function delete($id){
        $this->productCategoryService->delete([$id]);
        return $this->productCategoryService->getList([]);
    }
    public function update(UpdateRequest $request){
        $id = $request->get('id');
        $info = $this->productCategoryService->findById($id);
        if (!$info){
            return resFail('Không có thông tin');
        }
        $params = [
                'name' => $request->get('name'),
                'slug' => $request->get('slug'),
                'status' => $request->get('status'),
                'parent_id' => $request->get('parent_id'),
        ];
        return $this->productCategoryService->update($id,$params);
    }
}
