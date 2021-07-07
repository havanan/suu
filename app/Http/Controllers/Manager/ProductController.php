<?php

namespace App\Http\Controllers\Manager;

use App\Helpers\ResponsesApi;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateRequest;
use App\Http\Requests\Product\UploadImageRequest;
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
    public function getProperty(){
        $globals = new ResponsesApi();
        return $globals->resSuccessData($this->productService->getProperty());
    }
    public function uploadImage(UploadImageRequest $request){
        $file = $request->file('file');
        if (!$file) {
            return [];
        }
        $imageName = uploadImage($file,'products');
        $params = [
          'name' => $imageName,
          'folder' => 'products'
        ];
        $info = $this->productService->createMedia($params);
        return [
                'name' => $imageName,
                'size' => $file->getSize(),
                'id' => isset($info->id) ? $info->id : null
        ];
    }
}
