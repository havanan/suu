<?php

namespace App\Http\Controllers\Manager;

use App\Helpers\ResponsesApi;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Http\Requests\Product\UploadImageRequest;
use App\Services\Product\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

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
        return $this->productService->getList($params);
    }
    public function create(){
        $id = null;
        return view('manager.product.create',compact('id'));
    }
    public function save(CreateRequest $request){
        $params = $request->all();
        $this->productService->create($params);
        return $this->productService->getList([]);
    }
    public function edit($id){
        return view('manager.product.create',compact('id'));
    }
    public function update(UpdateRequest $request){
        $id = $request->get('id');
        $newImages = $request->get('images');
        $name = $request->get('name');
        $slug = $request->get('slug');
        $size = $request->get('size');
        $color = $request->get('color');
        $name .= ' '.$size.' '.$color;
        $slug = $slug != null ? $slug : Str::slug($name,'-');
        $params = [
                'name' => $name,
                'slug' => $slug,
                'description' =>$request->get('description'),
                'status' =>$request->get('status'),
                'price' =>$request->get('price'),
                'price_discount' =>$request->get('price_discount'),
                'price_import' =>$request->get('price_import'),
                'category_id' =>$request->get('category_id'),
                'parent_id' =>$request->get('parent_id'),
                'size' =>$size,
                'color' =>$color,
                'unit' =>$request->get('unit'),
                'image' => $newImages != null ? json_encode($newImages) : null
        ];
        return $this->productService->update($id,$params);
    }
    public function delete($id){
        $ids = $this->productService->getChildIds($id);
        $this->productService->delete($ids);
        return $this->productService->getList([]);
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
    public function mediaList($page = false){
        $dir = public_path('/cdn/products/small');
        if ($page !== false) {
            $dir .= '/' . $page;
        }
        return collect(File::allFiles($dir))
            ->filter(function ($file) {
                return in_array($file->getExtension(), ['png', 'gif', 'jpg']);
            })
            ->sortByDesc(function ($file) {
                return $file->getCTime();
            })
            ->map(function ($file) {
                return $file->getRelativePathname();
            });
    }
    public function getInfo($id){
        return $this->productService->getInfo($id,true);
    }
}
