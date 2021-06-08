<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateRequest;
use App\Services\Product\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productService;
    public function __construct(ProductService $productService){
        $this->productService = $productService;
    }
    public function index(){
        return view('manager.product.index');
    }
    public function getList(Request $request){
        $params = $request->all();
        $data = $this->productService->getList($params);
        return $data;
    }
    public function create(){
        $id = null;
        return view('manager.product.create',compact('id'));
    }
    public function save(CreateRequest $request){
        return view('manager.product.create');
    }
    public function edit($id){
        return view('manager.product.create',compact('id'));
    }
    public function update(CreateRequest $request){
        return view('manager.product.create');
    }
    public function delete($id){

    }
}
